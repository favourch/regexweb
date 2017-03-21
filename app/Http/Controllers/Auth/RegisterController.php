<?php

namespace App\Http\Controllers\Auth;

use App\dept;
use App\lecturer;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/lecturers';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:lecturers',
            'password' => 'required|min:6|confirmed',
	        'staffid' => 'unique:lecturers'
        ]);
    }



	public function showRegistrationForm()
	{
		$depts = dept::all();
		return view('auth.register',['depts' => $depts]);
	}


    /**
     * Create a new lecturer instance after a valid registration.
     *
     * @param  array  $data
     * @return lecturer
     */
    protected function create(array $data)
    {

	    $dept = dept::where('name',$data['dept'])->get()[0];

        return lecturer::create([


            'staffid' => $data['staffid'],
            'name' => $data['name'],
            'qualification' => $data['qualification'],
            'phone' => $data['phone'],
            'role' => 'Lecturer',
            'email' => $data['email'],
            'did' => $dept->did,
            'password' => bcrypt($data['password']),
        ]);
    }
}
