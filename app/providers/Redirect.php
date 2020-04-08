<?php 

namespace app\providers;

class Redirect
{
    public function __construct($page)
    {
        if($page){
            header("Location: " . route($page));
            exit;
        }
    }

    public function back()
    {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}