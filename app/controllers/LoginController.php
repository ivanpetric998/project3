<?php

namespace app\controllers;

use app\requests\LoginRequest;
use app\services\UserServices;
use app\controllers\Controller;

class LoginController extends Controller
{

    public function doLogin($request)
    {
        try 
        {
            $loginRequest=new LoginRequest($request);
            $loginRequest->validate();

            $userServices=new UserServices();
            $userServices->login($request);

        } 
        catch (\PDOException $e) 
        {
            $this->returnGenericError();
        }

    }

    public function logout()
    {
        session()->forget('user');
        redirect('login');
    }
}