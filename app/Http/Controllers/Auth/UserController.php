<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        $this->validate($request,[
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $data = $request->all();
        $user = User::create([
            'fname' => $data['first_name'],
            'lname' => $data['last_name'],
            'sname' => $data['surname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
       return Redirect::create_sms($user->wasRecentlyCreated);
    }
}
