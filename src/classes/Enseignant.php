<?php
  
  namespace Isl\Profils\classes;
  use DateTime ;
 

  class Enseignant extends Personne {
       
        private $coursDispenses;
        private $dateEntree ;
        private $anciennete ;
        private $statut = "enseignant";  

        public function __construct($data){
            
            $this->coursDispenses= isset($data["coursDispenses"])?$data["coursDispenses"]:null;
            $this->dateEntree = new DateTime($data["dateEntree"]);
            parent::__construct($data["infoPerso"]); // appel du constructeur de la classe data

        }

        public function setCoursDispenses($cours){

            $this->coursDispenses = $cours;

        }
        public function setDateEntree(DateTime $date){

            $this->dateEntree = $date;

        }

        public function setAnciennete($anciennete){

            $this->anciennete = $anciennete;
            

        }

        public function getCoursDispenses(){

            return $this->coursDispenses;

        }
        public function getDateEntree(){

            return  $this->dateEntree ;

        }

        public function getAnciennete(){

            return  $this->anciennete ;

        }
        public function getStatut(){

            return $this->statut;

        }
        
        public function anciennete(){

            $currentDate = new DateTime("now"); // date actuelle

            $difference = $this->dateEntree->diff($currentDate); // difference entre la date d entree et celle d aujoudhui

            return $difference->format('%Y');


        }

    }



?>


