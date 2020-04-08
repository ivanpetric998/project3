<?php
namespace app\controllers;

use app\models\DB;

class Controller
{
    protected $data = null;

    protected function loadPage(string $page, $data = null)
    {
        include "app/view/fixed/head.php";
        include "app/view/fixed/nav.php";
        include "app/view/pages/{$page}.php";
        include "app/view/fixed/footer.php";
    }

    protected function returnGenericError(){
        session()->put("error","Server error, please try again later");
        redirect()->back();
    }

    protected function returnGenericErrorAjax(){
        json(["error"=>"Server error, please try again later"],500);
    }

}