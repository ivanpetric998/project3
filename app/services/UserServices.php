<?php

namespace app\services;

use app\models\User;

class UserServices
{
    private $user;

    public function __construct()
    {
        $this->user=new User();
    }

    public function register($request)
    {
        $array=[];

        $array[]=$request['name'];
        $array[]=$request['surname'];
        $array[]=$request['username'];
        $array[]=md5($request['password']);

        $this->user->insert($array);
    }

    public function login($request)
    {
        $user=$this->user->getUserUsernamePassword($request['username'],md5($request['password']));
        
        if(count($user)!=1){
            session()->put('errors',['Wrong username or password']);
            redirect()->back();
        }

        session()->put('user',$user[0]);
        redirect('/');
    }
}