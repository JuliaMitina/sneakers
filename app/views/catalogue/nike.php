<?php
 $file =  __DIR__ . '/products_inc.php'; //путь до файла
      if (file_exists($file)) {
         include $file;
     } else {
      echo '<img src="C:/web/OpenServer/domains/sneakers.ru/public/images/errors/4004.png">';
    }

?>







  
