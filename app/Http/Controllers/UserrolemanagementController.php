<?php

namespace App\Http\Controllers;

use App\Helpers\HelperFunction;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class UserrolemanagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $users = User::where('id', '!=', $user->id)->get();
        return view('userrole/list', compact('users'));
    }
    public function add()
    {
        // $accounts = Account::all();
        // compact('accounts')
        return view('userrole/add');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        $data = $request->all();

        // Create user record in DB
        $createUser = HelperFunction::createUser($data['name'], $data['email'], $data['role'], $data['phone'], $user->id,$imgName='');
        return Redirect::to("users")->with('success', 'Login to continue');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->all();
        // check if any pre lead data exists with this venue id
        $user = User::find($data['data_id']);
        $user->delete();
        return json_encode(array("status" => 1));
    }
}
