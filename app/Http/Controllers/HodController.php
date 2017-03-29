<?php

namespace App\Http\Controllers;

use App\course;
use App\lecturer;
use App\program;
use App\result;
use App\student;
use DiDom\Document;
use Dompdf\Dompdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;
use PHPExcel_IOFactory;


class HodController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('hod');
	}

	public function getIndex(){
		$courseCount = course::where('did',Auth::user()->Dept->did)->count();
		$studentCount = student::all()->count();
		$lecturerCount = lecturer::all()->count();
		$resultsCount = result::all()->count();


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


		return view('hod.home',['courseCount' => $courseCount,
		                          'studentCount' => $studentCount,
		                          'lecturerCount' => $lecturerCount,
		                          'resultsCount' => $resultsCount,
					              'news' => $news
		]);
	}

	public function addCourses() {

		return view('hod.addCourses');
	}

	public function assignCourses(){
		$courses = course::where('did',Auth::user()->did)->get();
		$lecturers = lecturer::where('did',Auth::user()->did)->get();
		return view('hod.assignCourses',
			['lecturers' => $lecturers,
			 'courses' => $courses
			]);
	}

	public function viewCourses() {
		$unassigned = course::where('lid', null)->where('did',Auth::user()->did)->get();

		$all = course::where('did',Auth::user()->did)->get();

		$assigned = $all->diff($unassigned);


		return view('hod.viewCourses',
			['unassigned' => $unassigned,
			 'assigned' => $assigned
			]);
	}

	public function messages(){

		$lecturers = lecturer::all();
		return view('lecturers.messages',[
			'lecturers' => $lecturers
		]);
	}

	public function approveResults() {

		$courses = course::where('did',Auth::user()->did)->get();

		$cids = $this->makeAnArray($courses,'cid');

		$pending = result::hydrateRaw("select * from results where cid in $cids and isHodApproved = '0'")->unique('batchNumber');
		$approved = result::hydrateRaw("select * from results where cid in $cids and isHodApproved = '1'")->unique('batchNumber');
		$rejected = result::hydrateRaw("select * from results where cid in $cids and isHodApproved = '2'")->unique('batchNumber');



		return view('hod.approveResults',[
			'pending' => $pending,
			'approved' => $approved,
			'rejected' => $rejected
		]);
	}

	public function addStudents() {

		$programmes = program::where('did',Auth::user()->did)->get();

		return view( 'hod.addStudents', [ 'programmes' => $programmes ] );
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

	public function resultReport( ) {

		$response = array();
		$lecturers = lecturer::where('did', Auth::user()->did)->get();


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



		return view('hod.resultReport',[
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

	public function viewStudentTranscript( $indexNo ) {

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

			return view( 'hod.viewTranscript', [
				'transcript' => $finalTranscript,
				'student'    => $student
			] );


	}

	public function getStudentTranscript( $indexNo ) {
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
							'creditHours' => $result->Course->creditHours,
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

		return view('transcriptPdf',[
			'transcript' => $finalTranscript,
			'student' => $student
		]);

	}


	public function downloadPDF($indexNo) {

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml($this->getStudentTranscript($indexNo));

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');


		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream();
	}


	public function viewResults($batchNumber){
		$results = result::where('batchNumber',$batchNumber)->get();

		return view('hod.viewResults',
			[
				'results' => $results
			]);
	}

	public function viewTranscript() {
		return view('hod.getViewTranscript');
	}

	public function viewReports() {


		$courses = course::where('did', Auth::user()->did )->get();

		return view('hod.viewReports',[
			'courses' => $courses
		]);
	}

	public function postAssignCourses( Request $request ) {
		$course = course::find($request->input('cid'));
		$course->lid = $request->input('lid');
		$course->save();
		echo "1";
	}

	public function postAddCourses( Request $request ) {

		$course = new course();
		$course->code = $request->input('code');
		$course->name = $request->input('name');
		$course->creditHours = $request->input('creditHours');
		$course->level = $request->input('level');
		$course->semester = $request->input('semester');
		$course->did = $request->input('did');
		$status = $course->save();


		if($status) $report = "Course added successfully!"; else $report = "Sorry an error occurred";

		return view('hod.addCourses', [ 'status' => $report]);
	}

	public function postBulkAddCourses( Request $request ) {


		try {


			$inputFileName = $request->file('file')->getClientOriginalName();
			$request->file('file')->move("uploads/admins/students",$inputFileName);

			/* Identify file, create reader and load file  */
			$inputFileType = PHPExcel_IOFactory::identify( getcwd()."/" . "uploads/admins/students/".$inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = PHPExcel_IOFactory::load(getcwd()."/" . "uploads/admins/students/".$inputFileName);

			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();


			//  Read a row of data into an array
			$rowData = $sheet->rangeToArray('A2:' . $highestColumn . $highestRow,
				NULL, TRUE, FALSE);


			$count=1;


			// add results to data base from file
			foreach($rowData as $cell){


				$course = new course();
				$course->name = $cell[0];
				$course->code = $cell[1];
				$course->creditHours = $cell[2];
				$course->level = $cell[3];
				$course->semester = $cell[4];
				$course->did = Auth::user()->did;
				$course->save();

			}


		}
		catch (Exception $e) {
			echo 'Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME);
		}

	}

	public function postApproveResults( $batchNumber ) {
		$results = result::where('batchNumber',$batchNumber)->get();

		foreach($results as $item){
			$result = result::find($item->resid);
			$result->isHodApproved = '1';
			$result->save();
		}
	}

	public function postRejectResults( $batchNumber ){
		$results = result::where('batchNumber',$batchNumber)->get();

		foreach($results as $item){
			$result = result::find($item->resid);
			$result->isHodApproved = '2';
			$result->save();
		}
	}

	public function postAddStudents(Request $request) {

		$programmes = program::all(); // to show list of programmes


		$password = Str::random(6);

		$student = new student();
		$student->studentid = $request->input('indexNumber');
		$student->surname = $request->input('surname');
		$student->othernames = $request->input('othernames');
		$student->society = $request->input('society');
		$student->email = $request->input('email');
		$student->gender = $request->input('gender');
		$student->nationality = $request->input('nationality');
		$student->level = $request->input('level');
		$student->session = $request->input('session');
		$student->progid = $request->input('programme');
		$student->phone = $request->input('phone');
		$student->password = $password;
		$status =	$student->save();

		mail($request->input('email'),"Your regex app credentials", "You have successfully been added to the regex app system
		for result retrieval. Please download the regex app from the app store. Login with your ID number and this password: $password" );


		if($status) $report = "Student added successfully!"; else $report = "Sorry an error occured";

		return view('hod.addStudents', ['programmes' => $programmes, 'status' => $report]);
	}

	public function postBulkAddStudents( Request $request ) {

		try {


			$inputFileName = $request->file('file')->getClientOriginalName();
			$request->file('file')->move("uploads/hods/students",$inputFileName);

			/* Identify file, create reader and load file  */
			$inputFileType = PHPExcel_IOFactory::identify( getcwd()."/" . "uploads/hods/students/".$inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = PHPExcel_IOFactory::load(getcwd()."/" . "uploads/hods/students/".$inputFileName);

			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();

			$time_pre = microtime(true);

			//  Read a row of data into an array
			$rowData = $sheet->rangeToArray('A2:' . $highestColumn . $highestRow,
				NULL, TRUE, FALSE);


			$count=1;


			// add results to data base from file
			foreach($rowData as $cell){

				$programme = program::where('progname',$cell[9])->get();

				$password = Str::random(6);

				$student = new student();
				$student->studentid = $cell[0];
				$student->surname = $cell[1];
				$student->othernames = $cell[2];
				$student->society = $cell[3];
				$student->email = $cell[4];
				$student->gender = $cell[5];
				$student->nationality = $cell[6];
				$student->level = $cell[7];
				$student->session = $cell[8];
				$student->progid = $programme[0]->progid;
				$student->phone = $cell[10];
				$student->password = $password;
				$student->save();

				mail($cell[4],"Your regex app credentials", "You have successfully been added to the regex app system for result retrieval. Please download the regex app from the app store. Login with your ID number and this password: $password" );

			}


		}
		catch (Exception $e) {
			die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
			    . '": ' . $e->getMessage());
		}


	}


	public function makeAnArray($data,$id){
		$appIds = "";

		foreach ($data as $item){
			$appIds .= $item->$id .',';
		}
		$appIds .= "0";
		$appIdsInBracket = "(".$appIds.")";
		return $appIdsInBracket;

	}

	function sendSms($phone,$Message){

		/* Variables with the values to be sent. */
		$owneremail="tobennaa@gmail.com";
		$subacct="clearance";
		$subacctpwd="clearance";
		$sendto= $phone; /* destination number */
		$sender="Regent Uni"; /* sender id */

		$message= $Message;  /* message to be sent */

		/* create the required URL */
		$url = "http://www.smslive247.com/http/index.aspx?"  . "cmd=sendquickmsg"  . "&owneremail=" . UrlEncode($owneremail)
		       . "&subacct=" . UrlEncode($subacct)
		       . "&subacctpwd=" . UrlEncode($subacctpwd)
		       . "&message=" . UrlEncode($message)
		       . "&sender=" . UrlEncode($sender)
		       ."&sendto=" . UrlEncode($sendto)
		       ."&msgtype=0";


//		/* call the URL */
//		if ($f = @fopen($url, "r"))  {
//
//			$answer = fgets($f, 255);
//
//			if (substr($answer, 0, 1) == "+") {
////				 "SMS to $dnr was successful.";
//			}
////			else  {
////				 "an error has occurred: [$answer].";  }
//		}
//
//		else  {   "Error: URL could not be opened.";  }
	}

}
