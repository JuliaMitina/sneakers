<?php

namespace app\core;
//подключение к БД
abstract class Model
{
    protected $db;
    public function __construct()
    {
        $this->db = new Db();
        // debug($this->db);
    }
    // public function auth($email, $password)
    // {
    //     $res = $this->db->auth($email, $password);
    //     if ($res) {
    //         return $res;
    //     } else {
    //         return false;
    //     }
       
    // }
   
}
