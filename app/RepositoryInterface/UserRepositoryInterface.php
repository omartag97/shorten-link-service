<?php

namespace App\RepositoryInterface;

use Illuminate\Http\Request;

interface UserRepositoryInterface{

    public function register(Request $request);

    public function login(Request $request);
}
