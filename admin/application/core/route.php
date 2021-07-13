<?php
require_once "../php/check-login.php";


class Route{
    static function start(){


        if(!CheckAdmin()){
            Route::AccessError403();
        }
        
        $controller_name = "Main";
        $action_name = "index";
        
        $routes = explode('/',$_SERVER['REQUEST_URI']);

        //получаем имя контроллера
        if (!empty($routes[2])){
            $controller_name = $routes[2];
        }

        //получаем имя экшена
        if (!empty($routes[3])){
            $action_name = $routes[3];
        }

        //добавляем префиксы
        $model_name = "Model_".$controller_name;
        $controller_name = "Controller_".$controller_name;
        $action_name = "action_".$action_name;

        //подцепляем файл с классом модели (файла модели может и не быть)
        $model_file = strtolower($model_name).".php";
        $model_path = "application/models/".$model_file;

        if (file_exists($model_path)){
            include "application/models/".$model_file;
        }

        //подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_name).".php";
        $controller_path = "application/controllers/".$controller_file;
        if (file_exists($controller_path)){
            include "application/controllers/".$controller_file;
        }
        else{
            Route::ErrorPage404();
        }

        //создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;

        if (method_exists($controller,$action)){

            //вызываем действие контроллера
            $controller->$action();

        }
        else{
            Route::ErrorPage404();
        }
    }
    function AccessError403(){
        $host = 'https://'.$_SERVER['HTTP_HOST'].'/';
        header("Status: 403");
        header('Location:'.$host.'403');
    }
    function ErrorPage404(){
        $host = 'https://'.$_SERVER['HTTP_HOST'].'/';
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}