<?php

namespace app\controllers;

use app\requests\InsertCommentRequest;
use app\controllers\Controller;
use app\models\Comment;

class CommentsController extends Controller
{
    private $comment;

    public function __construct()
    {
        $this->comment=new Comment();
    }

    public function showCommentsForCategory($request)
    {
        try
        {
            $idCat=isset($request['idCat'])?$request['idCat']:0;
            $comments=$this->comment->getAllForCategory($idCat);
            json($comments);
        } 
        catch (\Exception $e)
        {
            $this->returnGenericErrorAjax();
        }
    }

    public function store($request)
    {
        try 
        {
            $insertCommentRequest=new InsertCommentRequest($request);
            $insertCommentRequest->validate();

            $array=[
                $request['text'],
                $request['category'],
                session()->get('user')->idUser,
                empty($request['parent'])?null:$request['parent']
            ];

            $this->comment->insert($array);

            json([],201);
        } 
        catch (\Exception $e) 
        {
            $this->returnGenericErrorAjax();
        }
    }
}
