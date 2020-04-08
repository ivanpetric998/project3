<?php

namespace app\controllers;

use app\requests\RegisterRequest;
use app\services\UserServices;
use app\controllers\Controller;

class RegisterController extends Controller
{

    public function store($request)
    {
        try 
        {
            $registerRequest=new RegisterRequest($request);
            $registerRequest->validate();

            $userServices=new UserServices();
            $userServices->register($request);

            json([],201);
        } 
        catch(\Exception $e)
        {
            $this->returnGenericErrorAjax();
        }

    }
}