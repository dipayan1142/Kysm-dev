<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;
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
}
