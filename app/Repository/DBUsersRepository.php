<?php

namespace App\Repository;

use App\Models\User;
use App\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class DBUsersRepository implements UserRepositoryInterface
{
    public function register(Request $request)
    {
        // validate entry data
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|min:2|max:100',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:8|max:100',
        //     'confirm_password' => 'required|same:password',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'errors' => $validator,
        //     ]);
        // }

        // validate entry data
        $validated = $request->validated();
        if ($validated->fails()) {
            return redirect()->back()->withErrors($this->validated);
        }

        // saving the value in varaible (Password)
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');

        // creating new object from model User
        $user = new User();


        // Storing name , email and password into the database
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Encryption (Hashing the password)
        $user->password = Hash::make($password);
        $user->confirm_password = Hash::make($confirm_password);

        // Creating Random acces_token
        $user->acces_token = str::random(64);

        // saving the data into the database
        $user->save();

        // return JSON API (User access token)
        return response()->json([
            'acces_token' => $user->acces_token,
            'name' => $user->name,
            'email' => $user->email
        ]);
    }

    public function login(Request $request)
    {

        // Get user Credintial (Email & Password)
        $cred = array('name' => $request->name, 'email' => $request->email, 'password' => $request->password);

        // Validation (if the Email & the Password is existing)
        if (Auth::attempt($cred)) {
            // checking if the current user has access_token or not
            if (!isset(Auth::user()->access_token)) {
                Auth::user()->access_token = str::random(64);
                Auth::user()->save;
            }
            // return [(Auth::user) >> the current user] name , email and access token
            return response()->json([
                'acces_token' => Auth::user()->acces_token,
                'email' => Auth::user()->email,
                'name' => Auth::user()->name
            ]);
        } else {
            return 'Not Valid Credintial!';
        }
    }
}
