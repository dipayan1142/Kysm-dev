<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;
use App\Models\ContactUs;
use Session;
class HomeController extends Controller
{
    public function home(Request $request)
    {
        $data=[];
        $getPropularCourse = DB::table('courses')
		->select('courses.*')
        ->where('is_propular_course', '1')
        ->where('courses.status', '1')
        ->whereNull('courses.deleted_at')
        ->orderBy('created_at', 'DESC')
		->get();
		$data['propular_course']=$getPropularCourse;

        $getCenter = DB::table('users')
		->select('users.*')
        ->leftJoin('user_roles', 'user_roles.user_id', '=', 'users.id')
        ->where('user_roles.role_id', '2')
        ->where('users.status', '1')
        ->whereNull('users.deleted_at')
        ->orderBy('users.created_at', 'DESC')
		->get();
		$data['center']=$getCenter;
     
        return view('welcome',['all_data'=>$data]);
    }

    public function contact(Request $request)
    {
        return view('contact');
    }

    public function about_us(Request $request)
    {
        $data=[];
        $getPropularCourse = DB::table('courses')
		->select('courses.*')
        ->where('is_propular_course', '1')
        ->where('courses.status', '1')
        ->whereNull('courses.deleted_at')
        ->orderBy('created_at', 'DESC')
		->get();
		$data['propular_course']=$getPropularCourse;

     
        return view('about',['all_data'=>$data]);
    }

    public function save_contact(Request $Request)
    {
		$insert = [
            'contact_name' => $Request->contact_name,
            'contact_email' => $Request->contact_email,
            'subject' => $Request->subject,
            'message'=>$Request->message,

		];
		if (ContactUs::create($insert)) {
            Session::flash('message', 'Message send successfully');
            return redirect('/contact');
        } else {
            Session::flash('message', 'Failed! Something Went Wrong');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/contact');
        }
	}

    public function course(Request $request)
    {
        return view('course');
    }
}
