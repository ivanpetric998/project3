<?php

use app\providers\Session;
use app\providers\Redirect;
use app\providers\DB;

function asset($path){
    return FULL_URL . "/public" . addFirstSlashIfNotExist($path);
}

function url(){
    return BASE_URL . $_SERVER['REQUEST_URI'];
}

function route($route){
    return FULL_URL . "/index.php" . addFirstSlashIfNotExist($route);
}

function getRoute(){
    $url=explode("?",$_SERVER['REQUEST_URI'])[0];
    return isset(explode(".php/",$url)[1])?explode(".php/",$url)[1]:"";
}

function addFirstSlashIfNotExist($path){
    $str=checkFirstSlash($path)?"":"/";
    $str.=$path;
    return $str; 
}

function checkFirstSlash($str)
{
    $reg="/^\//";
    if(preg_match($reg,$str)){
        return true;
    }
    return false;
}

function checkLastSlash($str)
{
    $reg="/\/$/";
    if(preg_match($reg,$str)){
        return true;
    }
    return false;
}

function session(){
    return new Session();
}

function redirect($page=null) {
    return new Redirect($page);
}

function DB(){
    return new DB(SERVER,DATABASE,USERNAME,PASSWORD);
}

function headers($header)
{
    switch ($header) {
        case 'Accept':
            return explode(",", $_SERVER['HTTP_ACCEPT'])[0];
        default:
            return null;
    }
}


function json($data = null, $statusCode = 200) 
{
        header("content-type: application/json");
        http_response_code($statusCode);
        echo json_encode($data);
}