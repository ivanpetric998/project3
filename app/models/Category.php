<?php

namespace app\models;

class Category
{
    public function getAll()
    {
        return DB()->select("SELECT * FROM category");
    }
}