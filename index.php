<?php
// MVC
// Models(модели) - работа с базой данных, определенный куски кода логики, подключаемые модули

// Views(виды) - работа с юзер, интерфейс

// Controllers(контроллеры) работа с информацией. Это файл который управляет определенной страницей

// Index.php от него все идет. За все
// это отвечают контроллеры
include 'app/lib/debug.php';
use app\core\Router;

spl_autoload_register(function($class) {
$class = str_replace('\\', '/', $class);
require_once "{$class}.php";
});

$router = new Router(); //маршрутизатор - отправляет к нужному контроллеру
$router->run();


