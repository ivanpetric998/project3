<?php 

namespace app\middlewares;

class IsLoggedIn
{
    public function handle()
    {
        if(!session()->has('user')){

            if(headers('Accept')=="application/json"){
                json([],403);
                exit;
            }

            redirect(route('403'));

        }
    }
}