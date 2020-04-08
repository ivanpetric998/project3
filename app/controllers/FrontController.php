<?php

namespace app\controllers;

use app\controllers\Controller;
use app\models\Category;

class FrontController extends Controller{
    
    public function loadLoginPage(){
        $this->loadPage('login');
    }

    public function loadRegisterPage(){
        $this->loadPage('register');
    }

    public function loadCommentsPage(){
        $category=new Category();
        $this->data['categories']=$category->getAll();
        $this->loadPage('comments',$this->data);
    }

    public function load404Page(){
        $this->loadPage('404');
    }

    public function load403Page(){
        $this->loadPage('403');
    }
}