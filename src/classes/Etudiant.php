<?php
  
  namespace Isl\Profils\classes;
  use Faker\Factory;
  use DateTime;
 
  class Etudiant extends Personne {
       
    private $coursSuivis;
    private $niveau;
    private $dateInscription;
    private $statut = "eleve";  
    
    public function __construct($data){
        
        $this->coursSuivis = isset($data["coursSuivis"])?$data["coursSuivis"]:null;
        $this->niveau =self::createNiveau();
        $this->dateInscription = new DateTime(self::createDate());
        parent::__construct($data["infoPerso"]); // appel du constructeur de la classe data

    }

    public function setCours($cours){

        $this->coursSuivis = $cours;

    }
    public function setNiveau($niveau){

        $this->niveau = $niveau;

    }
  

    public function setDateInscription(DateTime $dateInscription){

        $this->dateInscription = $dateInscription;
        

    }

    public function getCours(){

        return $this->coursSuivis ;

    }
    public function getNiveau(){

        return  $this->niveau ;

    }

    public function getDateInscription(){

        return  $this->dateInscription ;

    }
    public function getStatut(){

        return $this->statut;

    }

    static function createNiveau(){
        $faker = Factory::create();
        return $faker->randomDigit();
    }


  }



?>


