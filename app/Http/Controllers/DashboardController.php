<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
class DashboardController extends Controller {

	public function index() {
		$data                     = [];
		$data['breadcrumb']       = [
			'#' => 'Dashboard',
		];
		$getCenterCount = DB::table('user_roles')
		->leftJoin('users', 'user_roles.user_id','=','users.id')
		->select('users.id')
		->where('user_roles.role_id',2)
		->whereNull('users.deleted_at')
		->count();
		$data['total_center']=$getCenterCount;

		$getCourseCount = DB::table('courses')
		->select('courses.id')
		->whereNull('courses.deleted_at')->count();
		$data['total_course']=$getCourseCount;

		
		return view('admin.index', $data,['all_data'=>$data]);
	}
}
