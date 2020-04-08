<?php

namespace app\models;

class User
{
    public function insert($array)
    {
        $query="INSERT INTO `user`(`idUser`, `name`, `surname`, `username`, `password`) VALUES (NULL,?,?,?,?)";
        DB()->insert($query,$array);
    }

    public function getUserUsernamePassword($username,$password){
        $query="SELECT idUser,name,surname,username FROM user WHERE username=? AND password=?";
        return DB()->select($query,[$username,$password]);
    }
}