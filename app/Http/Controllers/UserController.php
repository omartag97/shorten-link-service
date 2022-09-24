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

class UserController extends Controller
{
    private $UserRepository;

    public function __construct(UserRepositoryInterface $UserRepository)
    {
        $this->UserRepository  = $UserRepository;
    }


    function register(RegistrationValidationRequest $request )
    {

        $register = $this->UserRepository->register($request);

        return $register ;
    }

    function login(Request $request)
    {

        $login = $this->UserRepository->login($request);

        return $login ;

    }
}
