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
		->where('user_roles.role_id',2)->count();
		$data['total_center']=$getCenterCount;

		
		return view('admin.index', $data,['all_data'=>$data]);
	}
}
