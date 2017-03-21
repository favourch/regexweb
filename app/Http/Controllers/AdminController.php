<?php

namespace App\Http\Controllers;

use App\course;
use App\dept;
use App\lecturer;
use App\program;
use App\result;
use App\resulthistory;
use App\student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PHPExcel_IOFactory;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('admin');
	}


	public function getIndex(){
		$courseCount = course::all()->count();
		$studentCount = student::all()->count();
		$lecturerCount = lecturer::all()->count();
		$resultsCount = result::all()->count();

		$sietStudents = $this->getStudentsByFaculty(1);
		$sblStudents = $this->getStudentsByFaculty(2);
		$fasStudents = $this->getStudentsByFaculty(3);


	    return view('admin.home',[
		    'courseCount' => $courseCount,
            'studentCount' => $studentCount,
            'lecturerCount' => $lecturerCount,
            'resultsCount' => $resultsCount,
		    'sietStudents' => $sietStudents,
		    'sblStudents' => $sblStudents,
		    'fasStudents' => $fasStudents
	    ]);
    }

	public function getSettings(){
		return view('admin.settings');
	}

	public function messages(){

		$lecturers = lecturer::all();
		return view('lecturers.messages',[
			'lecturers' => $lecturers
		]);
	}

	public function getStudentsByFaculty( $fid ) {
		$sietDepts = dept::where('fid',$fid)->get();
		$sietDeptArray = array();


		foreach($sietDepts as $item){
			array_push($sietDeptArray,$item->did);
		}


		$sietProgs = program::whereIn('did',$sietDeptArray)->get();
		$sietProgKeys = array();
		foreach($sietProgs as $item){
			array_push($sietProgKeys,$item->progid);
		}


		$sietStudents = student::whereIn('progid',$sietProgKeys)->get();

		return $sietStudents;
	}

	public function changeRoles() {
		$lecturers = lecturer::all();

		return view('admin.changeRoles', ['lecturers' => $lecturers ]);
	}

	public function updateUsers() {

		$lecturers = lecturer::all();
		$students = student::all();

//		if(Input::has('lSearch')){
//			$search = Input::get('search');
//			$search = '%' . $search . '%';
//
//			$lecturers = lecturer::where('name', 'like' , $search )->get();
//
//		}

//		if(Input::has('sSearch')){
//			$search = Input::get('search');
//			$students = $students->Where('name', 'like', '%' . $search . '%');
//
//		}

		if( Input::has('sLevel') ) {

			$level = Input::get('sLevel');
			$students = $students->where('level',$level);

		}

		if(Input::has('sProg')) {
			$prog     = Input::get( 'sProg' );
			$students = $students->where( 'progid', $prog );
		}

		if(Input::has('lFaculty')){
			$faculty = Input::get('lFaculty');

			$filtered = collect();

			foreach($lecturers as $item){
				if($item->Dept->Faculty->name == $faculty){
					$filtered->push($item);
				}

				$lecturers = $filtered;
			}



		}
		if(Input::has('lRole')){
			$role = Input::get('lRole');
			$lecturers = $lecturers->where('role',$role);

		}
		if(Input::has('lDept')){
			$dept = Input::get('lDept');
			$lecturers = $lecturers->where('did',$dept);
		}




		return view('admin.updateUsers', ['lecturers' => $lecturers, 'students' => $students ]);
	}

	public function addStudents() {

		$programmes = program::all();

		return view('admin.addStudents', ['programmes' => $programmes]);
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

		return view('admin.addStudents', ['programmes' => $programmes, 'status' => $report]);
	}

	public function postBulkAddStudents( Request $request ) {

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

	public function postChangeRoles( Request $request ) {

		$lecturer = lecturer::find($request->input('lid'));
		$lecturer->role = $request->input('role');
		$lecturer->save();
	}

	public function postRollSemester(Request $request) {
		try {


			$inputFileName = $request->file('file')->getClientOriginalName();
			$request->file('file')->move("uploads/admins/rolled",$inputFileName);

			/* Identify file, create reader and load file  */
			$inputFileType = PHPExcel_IOFactory::identify( getcwd()."/" . "uploads/admins/rolled/".$inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = PHPExcel_IOFactory::load(getcwd()."/" . "uploads/admins/rolled/".$inputFileName);

			$sheet = $objPHPExcel->getSheet(0);
			$highestRow = $sheet->getHighestRow();
			$highestColumn = $sheet->getHighestColumn();

			$time_pre = microtime(true);

			//  Read a row of data into an array
			$rowData = $sheet->rangeToArray('A2:' . $highestColumn . $highestRow,
				NULL, TRUE, FALSE);


			$count=1;



			foreach($rowData as $cell){


				$student = student::where('studentid',$cell[0])->first();

				if($student->level ==  "PRE") {

					$student->level = 100;
					$student->save();

					mail($student->email,"Regent University - New level Assignment", "Congratulations $student->fname,\nYou have been moved a year ahead in the RUCST Results Portal." );

				}

				else if($student->level ==  "100") {
					$student->level = 200;
					$student->save();

					mail($student->email,"Regent University - New level Assignment", "Congratulations $student->fname,\nYou have been moved a year ahead in the RUCST Results Portal." );

				}

				else if($student->level ==  "200") {
					$student->level = 300;
					$student->save();

					mail($student->email,"Regent University - New level Assignment", "Congratulations $student->fname,\nYou have been moved a year ahead in the RUCST Results Portal." );

				}

				else if($student->level ==  "300") {
					$student->level = 400;
					$student->save();

					mail($student->email,"Regent University - New level Assignment", "Congratulations $student->fname,\nYou have been moved a year ahead in the RUCST Results Portal." );

				}

				else if($student->level ==  "400"){


					$results = result::where('sid',$student->sid)->get();

					foreach($results as $item ){
						$resultHistory = new resulthistory();
						$resultHistory->studentid = $student->studentid;
						$resultHistory->fname = $student->othernames;
						$resultHistory->sname = $student->surname;
						$resultHistory->phone = $student->phone;
						$resultHistory->email = $student->email;
						$resultHistory->staffID = $item->Lecturer->staffid;
						$resultHistory->lecturerName = $item->Lecturer->name;
						$resultHistory->courseName = $item->Course->name;
						$resultHistory->courseSemester = $item->Course->semester;
						$resultHistory->courseLevel = $item->Course->semester;
						$resultHistory->attendance = $item->attendance;
						$resultHistory->midsem = $item->midsem;
						$resultHistory->ca = $item->ca;
						$resultHistory->examscore = $item->examscore;
						$resultHistory->totalgrade = $item->totalgrade;
						$resultHistory->save();
					}
					$student->delete();

					mail($student->email,"Regent University - Graduation Note", "Congratulations $student->fname,\nYou have completed requirements for your degree. You are now an alumni. You would be moved to the alumni system. Thank you.\nIT Dept" );


				} // end 400 level code


			}


		}
		catch (Exception $e) {
			die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
			    . '": ' . $e->getMessage());
		}


	}

}
