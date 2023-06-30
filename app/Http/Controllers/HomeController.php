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

    public function course($id=null)
    {
        $data=[];
        $module = DB::table('course_module')
            ->select('course_module.*')
            ->where('course_module.status', '1')
            ->where('course_module.status', '1')
            ->whereNull('course_module.deleted_at')
            ->orderBy('course_module.created_at', 'DESC')
            ->get();
       
		

        if($id){
        
            $getCourse = DB::table('courses')
            ->select('courses.*')
            ->where('courses.module_id', $id)
            ->where('courses.status', '1')
            ->whereNull('courses.deleted_at')
            ->orderBy('created_at', 'DESC')
            ->get();

            $selectModule = DB::table('course_module')
            ->select('course_module.*')
            ->where('course_module.id', $id)
            ->first();
            $data['select_modules']=$selectModule;
        }else{

            $lastModule = DB::table('course_module')
            ->select('course_module.*')
            ->where('course_module.status', '1')
            ->where('course_module.status', '1')
            ->whereNull('course_module.deleted_at')
            ->orderBy('course_module.created_at', 'DESC')
            ->first();
            $id=@$lastModule->id;
            $getCourse = DB::table('courses')
            ->select('courses.*')
            ->where('courses.module_id', @$id)
            ->where('courses.status', '1')
            ->whereNull('courses.deleted_at')
            ->orderBy('created_at', 'DESC')
            ->get();
            $selectModule = DB::table('course_module')
            ->select('course_module.*')
            ->where('course_module.id', $id)
            ->first();
            $data['select_modules']=$selectModule;
        }
        $data['courses']=$getCourse;
        $data['modules']=$module;

        return view('course',['all_data'=>$data,'module_id'=>$id]);
    }

    public function course_details($module_id,$id)
    {
        $data=[];

        $data['courseDetails'] = DB::table('courses')
		->select('courses.*')
        ->where('courses.id', $id)
		->first();

        $data['semister'] = DB::table('semester')
		->select('semester.*')
        ->where('course_id', @$data['courseDetails']->id)
		->get();

        $data['module'] = DB::table('course_module')
            ->select('course_module.*')
            ->where('course_module.status', '1')
            ->where('course_module.status', '1')
            ->whereNull('course_module.deleted_at')
            ->orderBy('course_module.created_at', 'DESC')
            ->get();

        return view('course_details',['all_data'=>$data]);
    }

}
