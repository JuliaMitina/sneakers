<?php
namespace app\controllers;
use app\core\Controller;

class CartController extends Controller
{
public function indexAction() {

    $cart_data =  $this->model->getCart();
    $this->view->render($cart_data);
}


}
