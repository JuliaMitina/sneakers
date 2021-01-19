<?php
namespace app\controllers;
use app\core\Controller;

class CatalogueController extends Controller
{
    //экшены обращются к смодели и возвращают результат. Рузульт из модели предается на рендер
    public function indexAction()
    {
        
        // echo 'Контроллер:' . __CLASS__ . ' | Экшэн: ' . __METHOD__;
        // $data =  $this->model->getCategories();
        // debug( $data);
        $categories = $this->model->getCategories();
        //debug($categories);
        $this->view->render($categories);
    }

    public function adidasAction()
    {
        //обращ к методу
          $this->save_ses_cat_id(); 
          $arr = $this->model->getProducts($_SESSION['cat_id']);            
          $this->view->render($arr);  
    }


    public function nikeAction() 
    {
        $this->save_ses_cat_id();
        $arr = $this->model->getProducts($_SESSION['cat_id']);            
        $this->view->render($arr); 
    }


    //метод добавления в КОРЗИНУ
    public function add_to_cartAction()
    {
        if ($this->isAjax()) {
            if (isset($_POST['product_id']) and isset($_POST['count'])and isset($_POST['price'])) {
            $res = $this->model->addItemIntoCart($_SESSION['auth']['id'], $_POST['product_id'], $_POST['count'], $_POST['price']);
            echo json_encode($res);
            } else {
                echo 'false';
            }
        } else {
            echo '<img src="/public/images/errors/4004.png" width: "100%">';
        }
    }







    // public function getProducts($id_catalogue) 
    // {
    //     // $param_value = $_SESSION['cat_id'];
    //     // $param_name = 'catalogue_id';
    //     $arr = $this->model->getProducts($id_catalogue);
    //     // $arr = $this->model->getProductsNew();
    //     // $this_
    //     return $arr;
    // }
  

    //сохранение id продукта в каталоге в сессию, так как из url надо удалить get-параметр
     private function save_ses_cat_id()
     {
         if (isset($_GET['cat_id']) and !isset($_SESSION['cat_id'])) {
             $_SESSION['cat_id'] = $_GET['cat_id'];
            header('location: ' . $_SERVER['REDIRECT_URL']);
         } else if (isset($_GET['cat_id']) and isset($_SESSION['cat_id']) and $_SESSION['cat_id'] == $_GET['cat_id']) {
             header('location: ' . $_SERVER['REDIRECT_URL']);
        } else if (isset($_GET['cat_id']) and isset($_SESSION['cat_id']) and $_SESSION['cat_id'] != $_GET['cat_id']) {
            $_SESSION['cat_id'] = $_GET['cat_id'];
            header('location: ' . $_SERVER['REDIRECT_URL']);
        }
     }
}