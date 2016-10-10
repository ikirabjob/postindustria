<?php

/**
 * Created by PhpStorm.
 * User: ikirab
 * Date: 10/8/16
 * Time: 6:24 AM
 */
class tableController extends controller
{
    public function __construct()
    {
        $this->initView('table');
        $this->model('table');
    }

    public function actionIndex(){
        $items = $this->model->getAllData();
        $this->view->setData('items', $items);
        $this->view->view();
    }

    public function actionSave(){
       if(!empty($_POST)){
           $this->model->save($_POST);
           header('Location: /');
       }
    }
}