<?php

namespace app\models;

class Comment
{
    public function getAllForCategory($idCat)
    {
        $query="SELECT c.*, u.idUser,u.username FROM comment c JOIN user u ON c.idUser=u.idUser WHERE c.idCategory=? ORDER BY date DESC";
        return DB()->select($query,[$idCat]);
    }

    public function insert($array)
    {
        $query="INSERT INTO comment(idComment, text, idCategory, idUser, date, parent) VALUES (NULL,?,?,?,NOW(),?)";
        DB()->insert($query,$array);
    }
}