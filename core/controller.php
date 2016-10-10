<?php

/**
 * Created by PhpStorm.
 * User: ikirab
 * Date: 10/8/16
 * Time: 7:41 AM
 */

abstract class controller
{
    public $model;
    public $view;

    public static $model_prefix = 'Model';


    public function model($model){
        require_once('./model/'.strtolower($model).self::$model_prefix.'.php');
        $modelname = strtolower($model).self::$model_prefix;
        return $this->model = new $modelname();
    }

    public function initView($model){
        $this->view = new view($model);
    }

    public function actionIndex()
    {
    }

}
