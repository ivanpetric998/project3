<?php

namespace app\providers;

class Session{

    public function has($name)
    {
        if(!isset($_SESSION[$name]))
            return false;

        return true;
    }

    public function get($name)
    {
        if(!$this->has($name))
            return null;
        
        return $_SESSION[$name];
    }

    public function put($name,$content)
    {
        $_SESSION[$name]=$content;
    }

    public function forget($name)
    {
        if($this->has($name))
            unset($_SESSION[$name]);
    }

    public function flush()
    {
        session_destroy();
    }
}