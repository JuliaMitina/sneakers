<?php
namespace app\controllers;
use app\core\Controller;
//контроллер главной страницы
class MainController extends Controller
{
    public function indexAction()
    {
        // $data = $this->model->getCategories();
        // $resSale = $this->model->getProductSale();
        // $data = array_merge($resCategories, $resSale);
        // foreach ($resSale as $key => $value) {
        //     # code...
        // }
        // $this->save_ses_cat_id(); 
       $this->view->render('indexAction');
    }
}
?>