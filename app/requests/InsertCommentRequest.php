<?php

namespace app\requests;

use app\requests\Request;

class InsertCommentRequest extends Request
{

    public function __construct($request)
    {
        parent::__construct($request);
    }

    public function rules()
    {
        return [
            "category"=>"required|exists:category,idCategory",
            "text"=>"required",
            "parent"=>"nullable"
        ];
    }
}

