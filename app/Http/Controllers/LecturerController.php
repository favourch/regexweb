<?php

namespace App\Http\Controllers;

use App\course;
use App\lecturer;
use App\program;
use App\response;
use App\result;
use App\setting;
use App\student;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use DiDom\Document;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use PHPExcel_IOFactory;
use Illuminate\Support\Facades\Auth;


class LecturerController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('lecturer');
	}


	public function index() {


		$courses = count(Auth::user()->Courses);


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

		return view('lecturers.home',[
			'news'=>$news,
			'course' => $courses
		]);
    }

	public function extract(){
//
//		$document = new Document('http://siet.regent.edu.gh/index.php/bsc-hons-information-systems-sciences/89-academics/167-programme-structure-information-systems-sciences', true);
//		$time_pre = microtime(true);
//
//		$table = $document->find('table');
//		foreach($table as $item){
//			$trs = $item->find('tr');
//			for($i=0;$i<count($trs); $i++){
//				$courseName = $trs[$i]->find('td')[0]->text();
//				$creditHours = $trs[$i]->find('td')[1]->text();
//
//
//				if($courseName != " Course ID and Name" && $courseName != "Semester 1" && $courseName != "Semester 2" && !str_contains($courseName, "Minimum credit hours required for the degree")){
//					$course = new course();
//					$course->creditHours = $creditHours;
//					$course->name =	$courseName;
//					$course->save();
//				}
//
//
//			}
//		}
//
//		$time_post = microtime(true);
//		$exec_time = $time_post - $time_pre;
//
//		echo "<br><br> Process took " .$exec_time;

	}

	public function messages(){

		$lecturers = lecturer::all();
		return view('lecturers.messages',[
			'lecturers' => $lecturers
		]);
	}

	public function responses(){

		$responses = response::all();

		return view('lecturers.responses');
	}


	public function upload(){

		return view('lecturers.upload');
	}

	public function viewResults() {

		$results = result::where("lid",Auth::user()->lid)->get();

		$response = new Collection();
		if(Input::has("level")){
			foreach($results as $item){
				if($item->Student->level == Input::get("level")){
					$response->push($item);
				}
			}
			$results = $response;
		}
		return view('lecturers.viewResults',['results' => $results]);
	}

	public function postUpload(Request $request){

			/** Create a new Excel5 Reader  **/
			try {



				$inputFileName = $request->file('file')->getClientOriginalName();
				$request->file('file')->move("uploads/lecturers/results",$inputFileName);

				$downloadUrl = url("/uploads/lecturers/results/".$inputFileName);

				/* Identify file, create reader and load file  */
				$inputFileType = PHPExcel_IOFactory::identify( getcwd()."/" . "uploads/lecturers/results/".$inputFileName);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = PHPExcel_IOFactory::load(getcwd()."/" . "uploads/lecturers/results/".$inputFileName);

				$sheet = $objPHPExcel->getSheet(1);
				$highestRow = $sheet->getHighestRow();
				$highestColumn = $sheet->getHighestColumn();

				$time_pre = microtime(true);

				//  Read a row of data into an array
				$rowData = $sheet->rangeToArray('C17:' . $highestColumn . $highestRow,
					NULL, TRUE, FALSE);


				$count=1;


				// determine batch number
				$lastResult = result::all()->last();

				if(!empty($lastResult) && !is_null($lastResult)){
					$lastBatchNumber = $lastResult->batchNumber;
					$batchNumber = $lastBatchNumber + 1;
				} else
					$batchNumber = 0;




				// add results to data base from file
				foreach($rowData as $cell) {

					try{

						if ( ! empty( $cell[1] ) ) {
							$student = student::where( 'studentid', $cell[0] )->get();


							$result              = new result();
							$result->attendance  = $cell[1];
							$result->midsem      = $cell[2];
							$result->ca          = $cell[1] + $cell[2];
							$result->examscore   = $cell[4];
							$result->totalgrade  = $cell[1] + $cell[2] + $cell[4];
							$result->batchNumber = $batchNumber;
							$result->cid         = $request->input( 'cid' );
							$result->sid         = $student[0]->sid;
							$result->lid         = Auth::user()->lid;
							$result->downloadUrl = $downloadUrl;

							$result->save();

						}
					}
					catch(Exception $e){}

				}

				// update results count
				$lecturer                  = lecturer::find( Auth::user()->lid );
				$previousValue             = $lecturer->resultsUploaded;
				$lecturer->resultsUploaded = $previousValue + 1;
				$lecturer->save();

			}
			catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
				    . '": ' . $e->getMessage());
			}



	}



}

class News {
	public $title;
	public $link;
	public $image;
}