<?php

namespace app\requests;


class Request
{

    protected $request;

    public function __construct($request)
    {
        $this->request=$request;
    }

    public function validate(){

        $errors=[];

        foreach($this->rules() as $key=>$value){

            $rules=explode("|",$value);

            foreach($rules as $rule){
                $y=explode(":",$rule);
                switch ($y[0]) {
                    case 'required':
                        if(empty($this->request[$key])){
                            $errors[$key]=ucfirst($key) . " is required";
                        }
                        break;
                    case 'nullable':
                    break;
                    case 'reg':
                        if(!preg_match($y[1],$this->request[$key])){
                            $errors[$key]=ucfirst($key) . " is invalid";
                        }
                        break;
                    case 'exists':
                        $exists=explode(",",$y[1]);
                        $table=$exists[0];
                        $keyWord=$exists[1];
                        $result=DB()->select("SELECT * FROM {$table} WHERE {$keyWord}=?",[$this->request[$key]]);
                        if(!$result){
                            $errors[$key]=ucfirst($key) . " not exists in system";
                        }
                        break;
                    case 'unique':
                        $unique=explode(",",$y[1]);
                        $table=$unique[0];
                        $keyWord=$unique[1];
                        $result=DB()->select("SELECT * FROM {$table} WHERE {$keyWord}=?",[$this->request[$key]]);
                        if($result){
                            $errors[$key]=ucfirst($key) . " already exists in system";
                        }
                        break;
                    
                    default:
                        break;
                }

                if(isset($errors[$key]))
                    break;
            }

        }

        if(count($errors))
        {
            if(headers('Accept')=="application/json"){
                json(["errors"=>$errors],422);
                exit;
            }

            session()->put('errors',$errors);
            redirect()->back();
        }
    }

    protected function rules(){
        return;
    }
    
}