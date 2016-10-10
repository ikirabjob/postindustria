<?php

/**
 * Created by PhpStorm.
 * User: ikirab
 * Date: 10/8/16
 * Time: 6:29 AM
 */

class route
{


    public static function run()
    {

        $controller_prefix = 'Controller';
        $action_prefix = 'action';

        $url = explode('/', $_SERVER['REQUEST_URI']);

        $controller = 'table';
        $action = 'index';


        if(!empty($url[1]))
            $controller = $url[1];
        if(!empty($url[2]))
            $action = $url[2];


        $controller_file = strtolower($controller).$controller_prefix.'.php';
        $controller_name = '';
        $controller_path = "controller/".$controller_file;

        if(file_exists($controller_path))
        {
            $controller_name = strtolower($controller).$controller_prefix;
            include "controller/".$controller_file;
        }
        else
        {
            Route::ErrorPage404();
        }


        $controller = new $controller_name;

        $action = $action_prefix.ucfirst(strtolower($action));

        if(method_exists($controller, $action))
        {
            $controller->$action();
        }
        else
        {
            Route::ErrorPage404();
        }
    }

    public static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }

}