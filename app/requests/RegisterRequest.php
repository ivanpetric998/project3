<?php

namespace app\requests;

use app\requests\Request;

class RegisterRequest extends Request
{

    public function __construct($request)
    {
        parent::__construct($request);
    }

    public function rules()
    {
        return [
            "name"=>"required|reg:/^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,14})*$/",
            "surname"=>"required|reg:/^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,14})*$/",
            "username"=>"required|reg:/^[\d\w\_\-\.\@]{6,30}$/|unique:user,username",
            "password"=>"required|/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/"
        ];
    }
}