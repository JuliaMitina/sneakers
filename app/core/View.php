<?php

namespace app\core;

class View
{
    protected $route;
    protected $path;
    protected $layout = 'default'; //шаблон страницы
    public function __construct($route)
    {
        $this->route = $route;

        // путь: папка/название файла вида (без .php)
         $this->path = $route['controller'] . '/' . $route['action'];
        //  $this->render('dsds');
    }

    //отобразить из шаблона инфу на страницу
    public function render($data)
    {
        // debug($data);
         $layout = "app/views/layouts/{$this->layout}.php";
        $view = "app/views/{$this->path}.php";

        if (file_exists($view)) {
            ob_start();
            require_once $view;
            $content = ob_get_clean();
        } else {
            $content = '<img src="/public/images/errors/4004.png" width: "100%">';
        }

        if (file_exists($layout)) {
            require_once $layout;
        } else {
            $content = '<img src="/public/images/errors/4004.png" width: "100%">';
        }
    }
}
