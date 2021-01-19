<?php

namespace app\models;

use app\core\Model;
//модель для каталога
//обращается к бд и возвр результ из бд
class Catalogue extends Model
{
    //метод на получение категорий
     public function getCategories()
     {
         $res = $this->db->queryAll('catalogue');
         return $res;
            // debug($res);
     }
      public function getProducts($id_catalogue)
     {
          // $products = $this->db->queryAll('products', [$param_name => $param_value]); //SELECT * FROM `products` WHERE id_catalogue = id, которое в сессии
          $products = $this->db->queryAll('products', 'catalogue_id', $id_catalogue); //SELECT * FROM `products` WHERE id_catalogue = id, которое в сессии
    //      return $res;
       return $products;

     }

   
    public function addItemIntoCart($client_id, $product_id, $count, $price)
    {
        $product = $this->db->queryOne('cart', 'id', 'client_id',$client_id, 'product_id', $product_id);
        if ($product) {
            //.....
               }
            else {
            $res = $this->db->addItemIntoCart($client_id, $product_id, $count, $price);
           // return json_encode($res);
             if ($res == false) {
                return 'false';
            } else {
                //если товар был добавлен
               $client_card = $this->db->queryAll('cart', 'client_id', $client_id); //вся корзина пользователя
               foreach ($client_card as $key => $product) {
                $product_id = $product['product_id'];
                $item = $this->db->queryAll('products', 'id', $product_id);
               $name = $item[0]['name'];
               $image = $item[0]['image'];
               $client_card[$key]['name'] = $name;
               $client_card[$key]['image'] = $image;
            //    $client_card[$key]['image'] =  $product_id;

               }
               return $client_card;
            //    return $item;
             }
   
        }

    }
  


    
//  public function show_info_product($productId)
//      {
//          return $this->db->queryAll('products', 'id', $productId);
//      }

//}



}