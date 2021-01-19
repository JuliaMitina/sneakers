<?php

namespace app\models;

use app\core\Model;
//модель для каталога
//обращается к бд и возвр результ из бд
class Entrance extends Model
{
    //метод проверки пользовтеля на правильность ввода
    public function checkuser($mail, $password)
    {
      return  $this->db->checkuser($mail, $password);
    }


    public function registration($name, $lastname, $mail, $password)
    {
      return  $this->db->registration($name, $lastname, $mail, $password);
    }

   




}