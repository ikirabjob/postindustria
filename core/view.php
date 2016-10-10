<?php

/**
 * Created by PhpStorm.
 * User: ikirab
 * Date: 10/9/16
 * Time: 4:33 AM
 */
class view
{

    public $tplpath = './view/';
    public $model;
    public $vars = [];

    public function __construct($model = '')
    {
        $this->model = $model;
    }

    public function setData($key, $data = []){
        if(!array_key_exists($key,$this->vars)){
            $this->vars[$key] = $data;
        }

        return $this->vars;
    }

    public function getData(){
        if($this->vars and !empty($this->vars)){
            return extract($this->vars);
        }
    }

    public function view(){
        extract($this->vars);
        include $this->tplpath.$this->model.'.php';
    }

}