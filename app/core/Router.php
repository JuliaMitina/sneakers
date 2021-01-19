<?php

namespace app\core;

class Router
{   
    private $routes = []; //массив с регулярными выражен/маршруты(url)
    private $params = [];
    public function __construct()
    {
        // echo __CLASS__;  - полный путь до этого файла с классом
        $routes_arr = require_once 'app/config/routes.php'; //массив с маршрутами из файла
        // debug($routes_arr);

        foreach ($routes_arr as $route => $params) {
            // debug($route);
            // debug($params);
            $this->add($route, $params);
        }
    }


    private function add($route, $params)
    {
        $route = '#^' . $route . '$#'; //регулярное выражение, чтобы нельзя было в адресной строке записать одинаковый путь дважды, т.е. ^ и # фиксирует только первое вхождение маршрута
        $this->routes[$route] = $params; //маршруты(url),но с регулярными выражениями
        // debug($routes);
    }

    //сопоставляет путь, который введен в url или нажата ссылка с путями, которые у нас есть
    //метод нужен для того, чтобы понять если у нас такая страница которую ввели в адресную строку
    private function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/'); //путь в адресной строке после названия сайта/то что ввели в адресную строку
        $url = $this->removeQueryString($url);
        // echo $url; 
        // debug($this->routes);
        foreach ($this->routes as $route => $params) {
            // функция для работы с регулярными выражениями, где 1параметр регуляр выражение, а 2параметр то что в адресной строке(т.е. с чем сравниваем регулярку; в 3 параметр записывается, то что совпадет - это массив)
            if(preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    private function removeQueryString($url) {
       $param =  explode('?', $url); 
       return $param[0];
    //    debug($param);
    }

    public function run()
    {  
        if ($this->match()) {
            // debug($this->params);
            // формируем путь к файлу с класом, чтобы создать от него экземпляр
           $controller_name  = '\app\controllers\\' . ucfirst($this->params['controller']) . 'Controller';

           //проверка на существоание класса
           if (class_exists($controller_name)) {
            //    echo 'exist';
                $controller = new $controller_name($this->params);
// debug($this->params);
                $action_name = $this->params['action'] . 'Action';
                // echo $action_name;
                // проверка на существование метода внутри класса
                if (method_exists($controller, $action_name)) {
                      $controller->$action_name();
                } else {
                    echo 'Method ' . $action_name . ' does not exist';
                }
           } else {
                //    echo 'Controller' . $controller_name . ' doesnot exist';
                echo '<img src="/public/images/errors/4004.png" width: "100%">';
           }
        } else  {
            // echo 'Rout ' . $_SERVER['REQUEST_URI'] . ' does not exist';
            echo '<img src="/public/images/errors/4004.png" width: "100%">';
        }
    }
}
