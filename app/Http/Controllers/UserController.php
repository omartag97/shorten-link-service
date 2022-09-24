<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Requests\RegistrationValidationRequest;
use App\RepositoryInterface\UserRepositoryInterface;
use App\Repository\DBUsersRepository;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $UserRepository;

    public function __construct(UserRepositoryInterface $UserRepository)
    {
        $this->UserRepository  = $UserRepository;
    }


    function register(Request $request)
    {
        try {

            $validateUser = Validator::make($request->all(), [
                'name' => 'required|min:2|max:100',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|max:100',
                'confirm_password' => 'required|same:password',
            ]);

            if ($validateUser->fails()) {
                return response()->JSON([
                    'message' => 'Validation error',
                    'error' => $validateUser->errors(),
                ], 401);
            }

            $register = $this->UserRepository->register($request);

            return $register;
        } catch (\Throwable $th) {
            return response()->JSON([
                'message' => 'Validation error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    function login(Request $request)
    {
        try {

            $validateUser = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:8|max:100',
            ]);

            if ($validateUser->fails()) {
                return response()->JSON([
                    'message' => 'Validation error',
                    'error' => $validateUser->errors(),
                ], 401);
            }

            $login = $this->UserRepository->login($request);

            return $login;
        } catch (\Throwable $th) {
            return response()->JSON([
                'message' => 'Validation error',
                'error' => $th->getMessage(),
            ], 500);
        }

    }
}
