<?php
   
   namespace Isl\Profils\manager;
   use Isl\Profils\classes\Profil;
   use Faker\Factory;
   use PDO;

    abstract class PersonneManager  implements Profil{
      

          abstract public function  create($element);
          abstract public function  readOne($id);
          abstract public function  readAll();
          abstract public function update();
          abstract public function delete();
          abstract public function allDatas($element);
 
       
    }

?>