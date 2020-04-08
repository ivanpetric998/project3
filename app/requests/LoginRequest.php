<?php

namespace app\requests;

use app\requests\Request;

class LoginRequest extends Request
{

    public function __construct($request)
    {
        parent::__construct($request);
    }

    public function rules()
    {
        return [
            "username"=>"required|reg:/^[\d\w\_\-\.\@]{6,30}$/|exists:user,username",
            "password"=>"required"
        ];
    }
}