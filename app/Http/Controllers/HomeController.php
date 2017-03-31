<?php

namespace App\Http\Controllers;

use App\course;
use App\lecturer;
use App\message;
use App\response;
use App\result;
use App\student;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
class HomeController extends Controller
{
    public function getIndex()
    {
	    if(Auth::guest()) return redirect('/lecturers');
	    if(Auth::user()->role == "Lecturer")
		  return  redirect("/lecturers");

	    if(Auth::user()->role == "HOD")
		    return  redirect("/hods");

	    if(Auth::user()->role == "Dean")
		    return  redirect("/deans");

	    if(Auth::user()->role == "Admin")
		    return  redirect("/admins");

        return view('welcome');
    }

	public function getCourses($level, $semester){

		$courses = course::hydrateRaw("select * from courses where level = '$level' and semester = '$semester'");

		echo $courses;

	}

	public function changePassword(){
		if(!Auth::guest()){
			return view('auth.passwords.change');
		} else{
			return redirect('/login');
		}

	}

	public function getChangeProfilePic() {
		return view('changeProfilePic');
	}

	public function postChangeProfilePic(Request $request) {

		if($request->hasFile('photo')){
			$fileName = $request->file('photo')->getClientOriginalName();
			$request->file('photo')->move('uploads/profilePics', $fileName);

			$user = lecturer::find(Auth::user()->lid);
			$user->photo = url('uploads/profilePics/' .$fileName);
			$status = $user->save();

			if($status)
			$request->session()->flash('success','Profile photo changed');
			else
				$request->session()->flash('error','Sorry an error occurred. Please try again.');

			return redirect('/change-profile-pic');
		}
		$request->session()->flash('error','No photo uploaded. Please try again.');
		return redirect('/change-profile-pic');
	}


	public function postChangePassword(Request $request){
		if(!Auth::guest()){
			$oldpassword = $request->input('oldpassword');
			$password = $request->input('password');
			$confirmpassword = $request->input('confirmpassword');
			$user = lecturer::find(Auth::user()->lid);

			if(password_verify($oldpassword,$user->password) ){

				if($confirmpassword == $password){
					$user->password = bcrypt($password);
					$request->session()->flash("success","Password changed successfully");
					$user->save();
					return redirect('/change-password');

				}
				else{
					$request->session()->flash("error", "Both new passwords don't match. Please try again");
					return redirect('/change-password');
				}

			} else {
				$request->session()->flash("error", "Current Password is wrong. Please try again.");
				return redirect('/change-password');
			}


		} else {
			return redirect('/login');
		}
	}

	public function getMessages(Request $request) {
		$user = Auth::user()->lid;
		$sender = $request->input('lid');

		$messages = message::hydrateRaw("SELECT * FROM messages m where reciever in ( '$user','$sender')  and sender in ( '$user', '$sender') order by created_at");

		$response = ['timeline' => $messages];
		echo json_encode($response);
	}

	public function getStaffMessageUsers(Request $request){
		$user = Auth::user()->lid;
		$users = array();
		$response = array();

		$queryResults = message::hydrateRaw("SELECT * FROM messages where sender = '$user' or reciever = '$user' ") ;

		foreach( $queryResults as $row) {

			if($row['sender'] != $user)
				array_push($users,$row['sender']);

			if($row['reciever'] != $user)
				array_push($users,$row['reciever']);
		}

		$users = array_unique($users);

		$usersForQuery = $this->makeAnArray($users);

		$queryResults = Lecturer::hydrateRaw("SELECT * FROM lecturers where lid in $usersForQuery ") ;


		foreach($queryResults as $row){

			$lectuerer = Lecturer::find($row['lid']);
			$user = array();
			$user ['name'] = $row['name'];
			$user ['staffid'] = $row['staffid'];
			$user['photo'] = $row['photo'];
			$user ['lid'] = $row['lid'];
			$user ['dept'] = $lectuerer->Dept->name;
			$user ['role'] = $lectuerer->role;

			array_push($response, $user);
		}


		if(!empty($response)){
			echo json_encode($response,JSON_UNESCAPED_SLASHES);
		} else {
			echo 0;
		}


	}

	public function getStaffCommentUsers(Request $request){
		$lid =  Auth::user()->lid;
		$courses = course::where('lid',$lid)->get();
		$cidArray = array();
		$response = array();

		foreach($courses as $item){
			array_push($cidArray, $item->cid);
		}


		$queryResults = response::all()->whereIn("cid",$cidArray)->unique("sid");


		foreach($queryResults as $item){

			$user = array();
			$user ['name'] = $item->Student->surname . " " . $item->Student->othernames;
			$user ['studentid'] = $item->Student->studentid;
			$user ['course'] = $item->Course->name;
			$user ['prog'] = $item->Student->Programme->progname;
			$user ['level'] = $item->Student->level;
			$user ['gender'] = $item->Student->gender;
			$user ['cid'] = $item->Course->cid;
			$user ['sid'] = $item->Student->sid;
			array_push($response,$user);
		}


		if(!empty($response)){
			echo json_encode($response,JSON_UNESCAPED_SLASHES);
		} else {
			echo 0;
		}


	}

	public function lecturerGetComments( Request $request ) {
		$lecturer = lecturer::find($request->input('lid'));

		$courses = $lecturer->Courses;
		$cids = array();
		foreach($courses as $item){
			array_push($cids, $item->cid);
		}

		$comments = response::whereIn('cid',$cids)->get();

		$response = ['timeline' => $comments];
		echo json_encode($response);
	}

	public function studentGetComments( Request $request ) {
		$student = $request->input('sid');

		$comments = response::where('sid',$student)->get();

		$response = ['timeline' => $comments];
		echo json_encode($response);
	}

	public function postComment( Request $request ) {
		$comment = $request->input('comment');
		$studentid = $request->input('sid');
		$courseID = $request->input('cid');
		$from = $request->input('from');

		$fromLecturer = 0;

		if($from == "Lecturer")
			$fromLecturer = 1;

		$newComment = new response();
		$newComment->content = $comment;
		$newComment->sid = $studentid;
		$newComment->fromLecturer = $fromLecturer;
		$newComment->cid = $courseID;
		$status = $newComment->save();

		if($status) echo 1;
		else echo 0;
	}



	public function postSendMessage(Request $request){
		$message = $request->input('message');
		$sender = Auth::user()->lid;
		$reciever = $request->input('reciever');

		if(isset($message)  && isset($sender) && isset($reciever)){
			$status = message::hydrateRaw("insert into messages (sender, reciever, message) values ('$sender','$reciever','$message')");


			if( $status ){

				echo "1";

			} else {

				echo "0";

			}
		}

	}

	public function setMessageRead(Request $request){
		$user = Auth::user()->uid;

		$queryResult = message::hydrateRaw("update messages set isRead = 1 where reciever = '$user' and isRead = 0");

		if($queryResult)
			echo 1;
	}

	function makeAnArray($data){
		$appIds = "";

		foreach ($data as $item){
			$appIds .= $item .',';
		}
		$appIds .= "0";
		$appIdsInBracket = "(".$appIds.")";
		return $appIdsInBracket;

	}

	function studentLogin(Request $request){
		try {
			$studentid = $request->input( 'studentid' );
			$password  = $request->input( 'password' );
			$student   = student::where( 'studentid', $studentid )->where( 'password', $password )->first();

			$student->Programme->name;
			echo $student;
		}
		catch(Exception $e){
			echo "[]";
		}
	}

	public function studentTranscript( Request $request ) {
		$student = student::where('studentid',$request->input('studentid'))->first();

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
							'cid'        => $result->Course->cid,
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
		$semesterCodes = ["1001","1002","2001","2002","3001","3002","4001","4002","5001","5002","6001","6002"];

		foreach($semesterCodes as $item){

			// fill our array with blank data where there is no content
			// to help us reder transcript easier
			$stat = array_key_exists($item, $finalTranscript);
			if(!$stat){
				$finalTranscript[$item] = [];
			}

		}

		$finalTranscript['cwa'] = number_format( $sumOfTotalGrade / $noOfCourses, 2);

		$finalTranscript = collect($finalTranscript);

		echo $finalTranscript;
	}

	public function postCourseDetails( Request $request ) {
		$cid = $request->input('cid');


		$course = course::find($cid);

		$response['course'] = $course;
		$response['lecturer'] = $course->Lecturer;
		$response['dept'] = $course->Lecturer->Dept;
		echo collect($response);
	}

	public function postStudentChangePassword( Request $request ) {
		$oldpassword = $request->input('oldpassword');
		$password = $request->input('password');
		$studentid = $request->input('studentid');
		$student = student::where('studentid',$studentid)->first();

			if($oldpassword == $student->password){
				$student->password = $password;
				$student->isDefaultPassword = 0;
				$status = $student->save();
				if($status) echo 1;
				else echo 0;
			}
			else{

				echo 0;
			}

	}

	public function test($sid){
		$student = student::where('studentid', $sid)->first();
		$results = result::where('sid',$student->sid)->get();

		foreach($results as $item ){
			echo $fname = $student->othernames . "<br> ";
			echo $sname = $student->surname . "<br>";
			echo $phone = $student->phone . "<br>";
			echo $email = $student->email . "<br>";
			echo $lecturerName = $item->Lecturer->name . "<br>";
			echo $courseName = $item->Course->name . "<br>";
			echo $courseSemester = $item->Course->semester . "<br>";
			echo $attendance = $item->attendance . "<br>";
			echo $midsem = $item->midsem . "<br>";
			echo $ca = $item->ca . "<br>";
			echo $examscore = $item->examscore . "<br>";
			echo $totalgrade = $item->totalgrade . "<br>";

			echo "<br><hr>";
		}

		echo $results;

	}


}
