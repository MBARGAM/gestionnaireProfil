<?php

   namespace Isl\Profils\classes ;
   use Faker\Factory ;

    class  Personne {
    protected $id ;
    protected $nom ;
    protected $prenom ;
    protected $adresse ;
    protected $cp ;
    protected $pays;
    protected $societe ;

    protected function __construct($data){
        $this->id = isset($data["id"])?$data["id"]:null;
        $this->nom = isset($data["nom"])?$data["nom"]:null;
        $this->prenom = isset($data["prenom"])?$data["prenom"]:null;
        $this->adresse = isset($data["adresse"])?$data["adresse"]:null;
        $this->cp =isset($data["cp"])?$data["cp"]:null;
        $this->pays = isset($data["pays"])?$data["pays"]:null;
        $this->societe = isset($data["societe"])?$data["societe"]:null;

    }

    public function setId($id){
        if(is_numeric($id)){
            $this->id = $id ;
        }
    }
    public function setNom($nom){   
        $this->nom = $nom ;     
    }
    public function setPrenom($prenom){   
        $this->prenom = $prenom ;     
    }
    public function setAdresse($adresse){   
        $this->adresse = $adresse ;     
    }
    public function setCp($cp){   
      
            $this->cp= $cp ;
            
    }
     public function setPays($pays){   
     
            $this->pays= $pays ;
          
    }
    public function setSociete($societe){   
        $this->societe= $societe ;     
    }

    public function getId(){
      return $this->id ;
    }
    public function getNom(){
        return $this->nom ;
    }
    public function getPrenom(){
        return $this->prenom ;
    }
    public function getAdresse(){
        return $this->adresse ;
    }
    public function getCp(){
        return $this->cp ;
    }
    public function getPays(){
        return $this->pays ;
    }
    public function getSociete(){
        return $this->societe ;
    }

   static function createPersonne($nbre){

        $faker = Factory::create();
            $tablePersonne=[];
            for($i = 0 ; $i< $nbre ;$i++){
                
                $data= [];
                $data["nom"] = $faker->lastname();
                $data["prenom"] =$faker->firstname();
                $data["adresse"] =$faker->address();
                $data["cp"] =$faker->postcode();
                $data["pays"]=$faker->country();
                $data["societe"] =$faker->Company();
                $tablePersonne[]=$data;
            }

         return $tablePersonne ;

        }



    /*abstract function  create();
    abstract function  read();
    abstract function update();
    abstract function delete();*/
 


}

?>