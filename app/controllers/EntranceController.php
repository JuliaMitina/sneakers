<?php
namespace app\controllers;
use app\core\Controller;

class EntranceController extends Controller
{
    //экшены обращются к смодели и возвращают результат. Рузульт из модели предается на рендер
    public function indexAction()
    {
        
        // echo 'Контроллер:' . __CLASS__ . ' | Экшэн: ' . __METHOD__;
        // $data =  $this->model->getCategories();
        // debug( $data);
        // $categories = $this->model->getCategories();
        //debug($categories);
        $this->view->render(123124342);

    }
 //обработка данных из ajax для "ВХОД"
     public function checkuserAction()
    {
        if ($this->isAjax()) {
            if (isset($_POST['mail']) and isset($_POST['password'])) {
                // if(isset($_POST['email']) and isset($_POST['password'])) {
               //$res = $this->model->auth($_POST['email'], $_POST['password']);
               // debug($_SESSION['auth']);
               $res = $this->model->checkuser($_POST['mail'], $_POST['password']);

               if(!empty($res)) { //вернулось значение массив
                 // $_SESSION['auth'] = true; //по ключу все нормально пользователь есть
                 $_SESSION['auth'] = ['id' => $res['id'], 'login' => $res['login']];
                //   header('location: ' . $_SERVER['REDIRECT_URL']);
                 // exit();
              } 
               
            // }
        
            echo json_encode($res); // принять в зашифрованном виде массив(передаем в Ajax )
            } 
            else {
                 echo 'false';
            }
    
        }

}
 //обработка данных из ajax для "РЕГИСТРАЦИИ"
public function registrationAction() {
    if ($this->isAjax()) {
        if (isset($_POST['name']) and isset($_POST['lastname']) and isset($_POST['mail']) and isset($_POST['password'])) {
            // if(isset($_POST['email']) and isset($_POST['password'])) {
           //$res = $this->model->auth($_POST['email'], $_POST['password']);
           // debug($_SESSION['auth']);
           $res = $this->model->registration($_POST['name'], $_POST['lastname'], $_POST['mail'], $_POST['password']);
            // $res = [$_POST['mail'],$_POST['password']];
        echo json_encode($res);
        } 
        else {
             echo 'false';
        }

    }
        
}

}