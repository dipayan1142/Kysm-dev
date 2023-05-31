<?php

namespace App\Http\Controllers;

use App\Helpers\HelperFunction;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;


class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function postLogin(Request $request)
    {
        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            // Fetch user details
            $user = User::where('email', $request->email)->first();
            $user->last_login = date("Y-m-d"); // Update user last login
            $user->save();
            Auth::login($user);
            FacadesSession::put('user_id', $user->id);
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->with('error', "You have entered wrong credentials");
    }

    public function postRegister(Request $request)
    {
        // dd($request->all());
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        $data = $request->all();

        // Create user record in DB
        $createUser = HelperFunction::createUser($data['name'], $data['email'], $data['role'], $data['phone'], $imgName='');
        // $userData = User::create($data);
        return Redirect::to("login")->with('success', 'Login to continue');
    }

    public function logout()
    {
        FacadesSession::flush();
        Auth::logout();
        return Redirect('login');
    }

    public function account()
    {
        $user = Auth::user();
        return view('account.index', compact('user'));
    }

    public function updateAccount(Request $request)
    {
        $status = 0;
        $userDetails = Auth::user();
        $user = User::find($userDetails->id);

        $data = $request->all();

        $user->name = $data['name'];
        // Check if image is present
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $ext = $image->getClientOriginalExtension();
            $fileName = $image->getClientOriginalName();

            // Check extension and upload image
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'webp') {
                $imgName = time() . $fileName;
                $destinationPath = public_path('/uploads/users');
                $image->move($destinationPath, $imgName);
                $user->image = $imgName;
            }
        } else {
            $status = 1;
        }
        $user->save();

        return json_encode(array("status" => $status));
    }

    public function changePassword(Request $request)
    {
        $status = 0;
        $userDetails = Auth::user();
        $user = User::find($userDetails->id);

        $data = $request->all();

        $password1 = $data['password'];
        $password2 = $data['repassword'];

        if ($password1 == $password2) {
            $hashedPass = Hash::make($password1);
            $user->password = $hashedPass;
            $user->save();
        }

        return json_encode(array("status" => $status));
    }
}
