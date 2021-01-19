<?php

namespace app\models;

use app\core\Model;
//модель для каталога
//обращается к бд и возвр результ из бд
class Cart extends Model
{
    public function getCart()
    {
        $all_products_cart =  $this->db->queryAll('cart', 'client_id', $_SESSION['auth']['id']); //все товары корзины
        foreach ($all_products_cart as $key => $product_cart) {
            $product_id = $product_cart['product_id'];
            $info_product = $this->db->queryAll('products', 'id', $product_id); //"SELECT * FROM {$table_name} WHERE {$param} = ?"
            $count = $info_product[0]['name'];
            $description  = $info_product[0]['description'];
            $name  = $info_product[0]['name'];
            $image  = $info_product[0]['image'];
            $all_products_cart[$key]['name'] = $name;
            $all_products_cart[$key]['description'] = $description;
            $all_products_cart[$key]['name'] = $name;
            $all_products_cart[$key]['image'] = $image;
        }
        return $all_products_cart;

    }

}