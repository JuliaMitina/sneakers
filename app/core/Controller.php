<?php
namespace app\core;
session_start();
abstract class Controller
{
    protected $route;
    protected $view;
    protected $model;
    public function __construct($route)
    {
        // debug($route);
        $this->route = $route;
        $this->view = new View($route);
        $model_name = '\app\models\\'  . ucfirst($route['controller']);
        $this->model = new $model_name;
        // debug($this->view);
        // $this->model->getPages();
        // session_destroy();
        
        //ВЫХОД ИЗ ПРОФИЛЯ
        if (isset($_GET['do']) and $_GET['do'] = 'exit') {
            session_unset('do');
            header('location: http://sneakers.ru/' );
            // die();
         }
                

      //echo password_hash('12Aa/', PASSWORD_DEFAULT);
    //  debug( $_SESSION);
    }

    public function isAjax()
    {
        //Метод проверяет был ли ajax запрос или нет. Если да - то возвр Истина, иначе - Ложь
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
}
