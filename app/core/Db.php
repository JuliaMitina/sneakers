<?php

namespace app\core;

class Db
{
    protected $db;
    public function __construct()
    {   
        $db_name = 'app/config/db_config.php';
        if (file_exists($db_name)) {
            $db_config = require_once $db_name;
            }

        try {
            $this->db = new \PDO("mysql:host={$db_config['host']};dbname={$db_config['db_name']}", $db_config['user'], $db_config['password']);
            
        } catch(\PDOException $e) {
           die('DB connect ERROR!!!!');
        //    debug($e);
        }
        
    }

    //получение всех эл-тов
    public function queryAll($table_name, $param = null, $param_value = null)
    { 
        if ($param != null and $param_value != null) {
            $stmt = $this->db->prepare("SELECT * FROM {$table_name} WHERE {$param} = ?");
        } else {
            $stmt = $this->db->prepare("SELECT * FROM {$table_name}");
        }
            $stmt->execute([$param_value]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        // debug($stmt);
    }
    
    
    //получение одного эл-та
    public function queryOne($table_name, $field, $param1, $value1, $param2=null, $value2 = null,$param3 = null, $value3 = null) {
        if ($param2 and $value2) {
            $stmt = $this->db->prepare("SELECT {$field} FROM {$table_name} WHERE {$param1} = ? AND  {$param2} = ?");
            $stmt->execute([$value1, $value2]);
        } else if ($param3 and $value3) {
            $stmt = $this->db->prepare("SELECT {$field} FROM {$table_name} WHERE {$param1} = ? AND  {$param2} = ? AND {$param3} = ?");
            $stmt->execute([$value1, $value2, $value3]);
        } else {
            $stmt = $this->db->prepare("SELECT {$field} FROM {$table_name} WHERE {$param1} = ?");
            $stmt->execute([$value1]);
        }
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


    public function query($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    //Запрос на проверку данных из бд
     public function checkuser($mail, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM clients WHERE `login` = ?");
        $stmt->execute([$mail]); //передаем значения, которые вместо "?"
        $data = $stmt->fetch(\PDO::FETCH_ASSOC); //возвр ассоциативн массив(ключ,знач.)
        return $data;
        if ($data) {  //если что то вернулось, запрос выроланился
            // $password_hash = $data['password']; //хэшируем пароль
             if (password_verify($password, $data['password'])) { //проверяет на совпадение строки и хэша
              return $data;
             } else {
                return false;
            }    
         } 
        else {
            return false;
        }
    }


    public function registration($name, $lastname, $mail, $password) {
        $all_clients = $this->queryAll('clients');
        // return $all_clients[0]['login'];
        if(empty($all_clients)) { //если нет ни одного пользователя в табл.
            $check = 'true';
        }
        //1 - проверка на такой же мэйл в бд
        foreach($all_clients as $m) {
            if( $m['login'] == $mail) { //если такой мэйл зареган
                $check  = 'false';
            break;
            }  else {
                $check  = 'true';  //если такого польз. с мэйлом нет
            }
        } //конец проверки
        
         //2б- если польз. не сущ. - регистрируем
         if ($check == 'true') {
             $hash = password_hash($password, PASSWORD_DEFAULT); //хэшируем пароль
             // подготовить запрос
             $stmt = $this->db->prepare("INSERT INTO clients (`name`, `lastname`, `login`, `password`) VALUES ('$name', '$lastname', '$mail', '$hash')");
             $stmt->execute(); //выполняем запрос
             $data = $stmt->fetch(\PDO::FETCH_ASSOC); //возвращ. ассоциативн. массив результата запроса 
             return 'true';
         } else  {  //2а- если польз. существует - не регистрируем
             return 'false';
         }
        // return $data;

    }

    
    //на добавление товара в корзину
    public function addItemIntoCart ($client_id, $product_id, $count, $price)
 {
  $stmt = $this->db->prepare("INSERT INTO cart SET `client_id`=?,`product_id`=?, `count`=?, `price`=?"); 
  $res = $stmt->execute([$client_id,$product_id,$count, $price]);
  return $res;
  //$stmt->fetch(\PDO::FETCH_ASSOC);
 }





 

    }






