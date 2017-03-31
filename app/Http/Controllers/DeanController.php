<?php

namespace App\Http\Controllers;

use App\course;
use App\dept;
use App\faculty;
use App\lecturer;
use App\program;
use App\result;
use App\student;
use DiDom\Document;
use Dompdf\Dompdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeanController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
		$this->middleware('dean');

	}
	public function getIndex(){


		$deptsArray = $this->getDepts();

		$programs = program::whereIn('did',$deptsArray)->get();
		$programsArray = array();
		foreach($programs as $item) array_push($programsArray,$item->progid);

		$lecturers = lecturer::whereIn('did',$deptsArray)->get();

		$resultsCount = 0;
		foreach($lecturers as $item) $resultsCount += $item->resultsUploaded;



		$courseCount = course::whereIn('did',$deptsArray)->count();
		$studentCount = student::whereIn("progid",$programsArray)->count();
		$lecturerCount = lecturer::whereIn('did',$deptsArray)->count();

		try {
			$document = new Document( 'http://www.regent.edu.gh/', true );

			$posts = $document->find( '.bt-inner' );


			$news = array();

			for ( $i = 0; $i < 3; $i ++ ) {
				$item        = new News();
				$item->title = $posts[ $i ]->text();
				$item->link  = $posts[ $i ]->find( 'a' )[0]->attr( 'href' );

				array_push( $news, $item );

			}

			$images = $document->find( '.bt-center' );
			for ( $i = 0; $i < 3; $i ++ ) {
				$newsItem        = $news[ $i ];
				$newsItem->image = $images[ $i ]->find( 'img' )[0]->attr( 'src' );
			}
		}
		catch(Exception $e){
			$news = [];
		}


		return view('dean.home',['courseCount' => $courseCount,
		                        'studentCount' => $studentCount,
		                        'lecturerCount' => $lecturerCount,
		                        'resultsCount' => $resultsCount,
								'news' => $news
		]);
	}

	public function approveResults() {

		$deptsArray = $this->getDepts();

		$courses = course::whereIn('did',$deptsArray)->get();
		$coursesArray = array();

		foreach($courses as $item) array_push($coursesArray,$item->cid);

		$pending = result::whereIn('cid',$coursesArray)->get()->where("isHodApproved",1)->where("isDeanApproved",0)->unique("batchNumber");

		$approved = result::whereIn('cid',$coursesArray)->get()->where("isHodApproved",1)->where("isDeanApproved",1)->unique("batchNumber");

		$rejected = result::whereIn('cid',$coursesArray)->get()->where("isHodApproved",1)->where("isDeanApproved",2)->unique("batchNumber");



		return view('dean.approveResults',[
			'pending' => $pending,
			'approved' => $approved,
			'rejected' => $rejected
		]);
	}

	public function messages(){

		$lecturers = lecturer::all();
		return view('dean.messages',[
			'lecturers' => $lecturers
		]);
	}

	public function viewResults($batchNumber){
		$results = result::where('batchNumber',$batchNumber)->get();

		return view('dean.viewResults',
			[
				'results' => $results
			]);
	}

	public function viewCourses() {
		$deptArray = $this->getDepts();

		$unassigned = course::where('lid', null)->whereIn('did', $deptArray)->get();

		$all = course::whereIn('did',$deptArray)->get();

		$assigned = $all->diff($unassigned);


		return view('dean.viewCourses',
			['unassigned' => $unassigned,
			 'assigned' => $assigned
			]);
	}

	public function viewReports() {
		$deptsArray = $this->getDepts();

		$courses = course::whereIn('did',$deptsArray)->get();

		return view('dean.viewReports',[
			'courses' => $courses
		]);
	}

	public function viewTranscript() {
		return view('dean.getViewTranscript');
	}

	public function getCourseStats($cid){
		$results = result::where('cid',$cid)->get();
		$failed = $results->where('totalgrade','<',40);
		$passed = $results->where('totalgrade','>=',40);

		$response = array();
		$response['failed'] = $failed;
		$response['passed'] = $passed;
		$response['lecturer'] = $results[0]->Course->Lecturer->name;
		$response['photo'] = $results[0]->Course->Lecturer->photo;
		$response['scores'] = ['Score'];

		foreach($results as $item){
			array_push($response['scores'],$item->totalgrade);

		}

		sort($response['scores']);
		echo json_encode($response, JSON_UNESCAPED_SLASHES);

	}

	public function getStudentResults( $indexNo ) {
		$student = student::where('studentid',$indexNo)->first();

		$sumOfTotalGrade = 0;
		$noOfCourses = 0;

		$results = $student->Results;
		$transcript = array();

		foreach($results as $item){

			if($item->isHodApproved && $item->isDeanApproved) {
				$transcriptItem = array();

				$transcriptItem['level']    = $item->Course->level;
				$transcriptItem['semester'] = $item->Course->semester;
				array_push( $transcript, $transcriptItem );
			}
		}


		$transcript = array_unique($transcript,0);
		$transcript =  json_encode($transcript);

		$transcript = json_decode($transcript);

		$finalTranscript = array();

		foreach($transcript as $item){


			$semesterData = array();

			foreach($results as $result){
				if($result->isHodApproved && $result->isDeanApproved) {
					if ( $result->Course->level == $item->level && $result->Course->semester == $item->semester ) {

						$courseData = [
							'name'       => $result->Course->name,
							'attendance' => $result->attendance,
							'midsem'     => $result->midsem,
							'ca'         => $result->ca,
							'examscore'  => $result->examscore,
							'totalgrade' => $result->totalgrade
						];

						//increase total grade by course total grade
						//and count courses for cwa calculation
						$sumOfTotalGrade += $result->totalgrade;
						$noOfCourses++;

						array_push( $semesterData, $courseData ); // add course data to the semester


					}
				}
			}
			$finalTranscript[$item->level . $item->semester] = $semesterData;


		}

		// possible values for semester ID
		// its 6 to accomodate trimester
		$semesterCodes = ["1001","1002","2001","2002","3001","3002","4001","4002"];

		foreach($semesterCodes as $item){

			// fill our array with blank data where there is no content
			// to help us render transcript easier
			$stat = array_key_exists($item, $finalTranscript);
			if(!$stat){
				$finalTranscript[$item] = [];
			}

		}

		$finalTranscript['cwa'] = number_format( $sumOfTotalGrade / $noOfCourses, 2);


		$finalTranscript = collect($finalTranscript);

		return view('dean.viewTranscript',[
			'transcript' => $finalTranscript,
			'student' => $student
		]);

	}


	public function postApproveResults( $batchNumber ) {
		$results = result::where('batchNumber',$batchNumber)->get();

		foreach($results as $item){
			$result = result::find($item->resid);
			$result->isDeanApproved = '1';
			$result->save();

			$email = $result->Student->email;
			$name = $result->Student->surname . " " . $result->Student->othernames;
			$course = $result->Course->name;
			$message = "Hello $name, \n\nYour result for $course has been released. Please login to RUCST Results App".
			           "with your ID number to view your grade. \nThank you. \nIT Admin.";


			mail($email,"Regent University - New Result Released", $message);
		}

	}

	public function postRejectResults( $batchNumber ){
		$results = result::where('batchNumber',$batchNumber)->get();

		foreach($results as $item){
			$result = result::find($item->resid);
			$result->isDeanApproved = '2';
			$result->save();

		}
		$lastResult = result::where('batchNumber',$batchNumber)->get()->last();
		$lecturer = $lastResult->Lecturer->name;
		$lecturerEmail = $lastResult->Lecturer->email;
		$downloadUrl = $lastResult->downloadUrl;
		$course = $lastResult->Course->name;
		$message = "Hello $lecturer,\nThe results you uploaded for $course was rejected by the Dean. Please login to ".
		           "RUCST results portal to re-upload. Here is a link to the file you uploaded for your reference \n\n$downloadUrl\n\n".
		           "Thank you.\nIT Admin";
		mail($lecturerEmail,"Regent University - Result Rejected",$message);

	}


	public function getDepts(){
		$depts = dept::where('fid',Auth::user()->Dept->Faculty->fid)->get();
		$deptsArray = array();
		foreach($depts as $item) array_push($deptsArray,$item->did);

		return $deptsArray;
	}

	public function viewStudentTranscript( $indexNo ) {
		try {
			$student = student::where( 'studentid', $indexNo )->first();

			$sumOfTotalGrade = 0;
			$noOfCourses     = 0;

			$results    = $student->Results;
			$transcript = array();

			foreach ( $results as $item ) {

				if ( $item->isHodApproved && $item->isDeanApproved ) {
					$transcriptItem = array();

					$transcriptItem['level']    = $item->Course->level;
					$transcriptItem['semester'] = $item->Course->semester;
					array_push( $transcript, $transcriptItem );
				}
			}


			$transcript = array_unique( $transcript, 0 );
			$transcript = json_encode( $transcript );

			$transcript = json_decode( $transcript );

			$finalTranscript = array();

			foreach ( $transcript as $item ) {


				$semesterData = array();

				foreach ( $results as $result ) {
					if ( $result->isHodApproved && $result->isDeanApproved ) {
						if ( $result->Course->level == $item->level && $result->Course->semester == $item->semester ) {

							$courseData = [
								'name'        => $result->Course->name,
								'creditHours' => $result->Course->creditHours,
								'attendance'  => $result->attendance,
								'midsem'      => $result->midsem,
								'ca'          => $result->ca,
								'examscore'   => $result->examscore,
								'totalgrade'  => $result->totalgrade
							];

							//increase total grade by course total grade
							//and count courses for cwa calculation
							$sumOfTotalGrade += $result->totalgrade;
							$noOfCourses ++;

							array_push( $semesterData, $courseData ); // add course data to the semester


						}
					}
				}
				$finalTranscript[ $item->level . $item->semester ] = $semesterData;


			}

			// possible values for semester ID
			// its 6 to accomodate trimester
			$semesterCodes = [ "1001", "1002", "2001", "2002", "3001", "3002", "4001", "4002" ];

			foreach ( $semesterCodes as $item ) {

				// fill our array with blank data where there is no content
				// to help us render transcript easier
				$stat = array_key_exists( $item, $finalTranscript );
				if ( ! $stat ) {
					$finalTranscript[ $item ] = [ ];
				}

			}

			$finalTranscript['cwa'] = number_format( $sumOfTotalGrade / $noOfCourses, 2 );


			$finalTranscript = collect( $finalTranscript );

			return view( 'dean.viewTranscript', [
				'transcript' => $finalTranscript,
				'student'    => $student
			] );
		}
		catch(Exception $e){
				echo "Invalid ID number";
			}

	}

	public function getStudentTranscript( $indexNo ) {
		try {
			$student = student::where( 'studentid', $indexNo )->first();

			$sumOfTotalGrade = 0;
			$noOfCourses     = 0;

			$results    = $student->Results;
			$transcript = array();

			foreach ( $results as $item ) {

				if ( $item->isHodApproved && $item->isDeanApproved ) {
					$transcriptItem = array();

					$transcriptItem['level']    = $item->Course->level;
					$transcriptItem['semester'] = $item->Course->semester;
					array_push( $transcript, $transcriptItem );
				}
			}


			$transcript = array_unique( $transcript, 0 );
			$transcript = json_encode( $transcript );

			$transcript = json_decode( $transcript );

			$finalTranscript = array();

			foreach ( $transcript as $item ) {


				$semesterData = array();

				foreach ( $results as $result ) {
					if ( $result->isHodApproved && $result->isDeanApproved ) {
						if ( $result->Course->level == $item->level && $result->Course->semester == $item->semester ) {

							$courseData = [
								'name'        => $result->Course->name,
								'creditHours' => $result->Course->creditHours,
								'attendance'  => $result->attendance,
								'midsem'      => $result->midsem,
								'ca'          => $result->ca,
								'examscore'   => $result->examscore,
								'totalgrade'  => $result->totalgrade
							];

							//increase total grade by course total grade
							//and count courses for cwa calculation
							$sumOfTotalGrade += $result->totalgrade;
							$noOfCourses ++;

							array_push( $semesterData, $courseData ); // add course data to the semester


						}
					}
				}
				$finalTranscript[ $item->level . $item->semester ] = $semesterData;


			}

			// possible values for semester ID
			// its 6 to accomodate trimester
			$semesterCodes = [ "1001", "1002", "2001", "2002", "3001", "3002", "4001", "4002" ];

			foreach ( $semesterCodes as $item ) {

				// fill our array with blank data where there is no content
				// to help us render transcript easier
				$stat = array_key_exists( $item, $finalTranscript );
				if ( ! $stat ) {
					$finalTranscript[ $item ] = [ ];
				}

			}

			$finalTranscript['cwa'] = number_format( $sumOfTotalGrade / $noOfCourses, 2 );


			$finalTranscript = collect( $finalTranscript );

			return view( 'transcriptPdf', [
				'transcript' => $finalTranscript,
				'student'    => $student
			] );
		} catch(Exception $e){
			return "Invalid ID number";
		}
	}


	public function downloadPDF($indexNo) {

		try {
			// instantiate and use the dompdf class
			$dompdf = new Dompdf();
			$dompdf->loadHtml( $this->getStudentTranscript( $indexNo ) );

			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper( 'A4', 'landscape' );


			// Render the HTML as PDF
			$dompdf->render();

			// Output the generated PDF to Browser
			$dompdf->stream();
		}catch(Exception $e){
				echo "Invalid ID number";
			}
	}

	public function resultReport( ) {

		$response = array();
		$depts = $this->getDepts();
		$lecturers = lecturer::whereIn('did', $depts)->get();


		$count = 0;
		foreach($lecturers as $lecturer){


			$coursesArray = array();

			$courses = course::where('lid', $lecturer->lid)->get();



			foreach($courses as $item){
				$courseItem = array();
				$courseItem['name'] = $item->name;

				$results = result::where('cid',$item->cid)->get();


				if(count($results) <= 0) $denominator = 1;
				else $denominator = count($results);

				$failed = ($results->where('totalgrade','<',40)->count() / $denominator ) * 100 ;
				$passed = ($results->where('totalgrade','>=',40)->count() / $denominator ) * 100 ;
				$As = $results->where('totalgrade','>',70)->count();
				$Bs = $results->where('totalgrade','>=',60)->where('totalgrade','<',70)->count();
				$Cs = $results->where('totalgrade','>=',50)->where('totalgrade','<', 60)->count();
				$Ds = $results->where('totalgrade','>=',40)->where('totalgrade','<',50)->count();
				$Fs = $results->where('totalgrade','<',40)->count();

				$courseItem['failed'] = $failed;
				$courseItem['passed'] = $passed;
				$courseItem['as'] = $As;
				$courseItem['bs'] = $Bs;
				$courseItem['cs'] = $Cs;
				$courseItem['ds'] = $Ds;
				$courseItem['fs'] = $Fs;

				array_push($coursesArray,$courseItem);

			}


			$lecturerItem = array();
			$lecturerItem['name'] = $lecturer->name;
			$lecturerItem['courses'] = $coursesArray;
			array_push($response,$lecturerItem);

		}



		return view('dean.resultReport',[
			'data' => collect($response)
		]);

	}

	public function downloadResultReport() {

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml($this->resultReport());

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');

		$dompdf->set_option('isRemoteEnabled',true);

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream();
	}



}
