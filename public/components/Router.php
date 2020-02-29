<?php

class Router
{


    static function run()
    {
        // контроллер и действие по умолчанию
        $controller_name = 'index';
        $action_name = 'index';
        $param1 = 0;
        $param2 = 1;
//
//        echo "<pre>";
//        print_r($_SERVER);
//        die;



        $routes = explode('/', $_SERVER['REQUEST_URI']);


        // получаем имя контроллера
        if (!empty($routes[1])) {
            $controller_name = $routes[1];

//            echo "<pre>";
//            print_r($routes[1]);
////            die;
        }

        // получаем имя экшена
        if (!empty($routes[2]) && $routes[2] != null) {
            $action_name = $routes[2];
        }
//        echo "<pre>";
//        print_r($routes[2]); die;

        // получаем $p1
        if (!empty($routes[3])) {
//            $param1 = intval($routes[3]);
            $param1 = intval($routes[3]);
        }


        // получаем $p2
        if (!empty($routes[4])) {
            $param2 = intval($routes[4]);
        }



        // добавляем префиксы
        $model_name = 'model_' . strtolower($controller_name);
        $controller_name = 'controller_' . strtolower($controller_name);
        $action_name = 'action_' . strtolower($action_name);




        // подцепляем файл с классом модели (файла модели может и не быть)

        $model_file = $model_name . '.php';
        $model_path = "models/" . $model_file;
        if (file_exists($model_path)) {
            include "models/" . $model_file;
        }

        // подцепляем файл с классом контроллера
        $controller_file = $controller_name . '.php';
        $controller_path = "controllers/" . $controller_file;
        if (file_exists($controller_path)) {
            include "controllers/" . $controller_file;
        } else {
            /*
            правильно было бы кинуть здесь исключение,
            но для упрощения сразу сделаем редирект на страницу 404
            */
            Router::ErrorPage404();
            die;

        }


        // создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;

//                echo "<pre>";
//        print_r($controller_name);
//        echo "</pre>";
//        print_r($action_name);
//        die;


        if (method_exists($controller, $action)) {
            // вызываем действие контроллера
            $controller->$action($param1, $param2, $controller_name, $action_name);
        } else {
            // здесь также разумнее было бы кинуть исключение
            $controller->action_index($param1, $param2, $controller_name, $action_name);
        }

    }





    static function ErrorPage404()
    {
//        echo "Error 404 suka";
//        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
//        header('HTTP/1.1 404 Not Found');
//        header("Status: 404 Not Found");
        include ROOT . "/controllers/controller_404.php";
        $controller = new controller_404;
        $controller->action_index();

    }


}