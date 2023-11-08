<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses;

    public function login()
    {
        return $this->successResponse('', 'message', 200);
    }
    public function register()
    {
        return $this->successResponse('', 'message', 200);
    }
    public function logout()
    {
        return $this->successResponse('', 'message', 200);
    }
    public function forget_password()
    {
        return $this->successResponse('', 'message', 200);
    }
}
