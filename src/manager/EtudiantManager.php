<?php 

 namespace Isl\Profils\manager ;
use Isl\Profils\classes\Etudiant ;

 use PDO ;

 class EtudiantManager extends PersonneManager {
 
    private $connexion = null;

    public function __construct($connexion){
         $this->connexion = $connexion ;
     }

     public  function setConnexion($connexion){
         $this->connexion = $connexion;
     }

     public  function getConnexion(){
      return $this->connexion ;
     }


    
    public  function  create($etudiant){
  
     /*insertion des  valeurs generales  dans la table elevesEnseignant
     et on termine  avec l insertion via la table cours*/
        $req = $this->connexion 
        ->prepare("INSERT INTO elevesEnseignant (nom,prenom,adresse,cp,pays,societe,statut,date_entree,niveau) 
        VALUES (:nom,:prenom,:adresse,:cp,:pays,:societe,:statut,:date_entree,:niveau)");

        $req->bindValue(':nom',$etudiant->getNom());
        $req->bindValue(':prenom',$etudiant->getPrenom());
        $req->bindValue(':adresse',$etudiant->getAdresse());
        $req->bindValue(':cp',$etudiant->getCp());
        $req->bindValue(':pays',$etudiant->getPays());
        $req->bindValue(':societe',$etudiant->getSociete());
        $req->bindValue(':statut',$etudiant->getStatut());
        $req->bindValue(':niveau',$etudiant->getNiveau());
        $req->bindValue(':date_entree',$etudiant->getDateInscription()->format('Y-m-j'));
        $req->execute();

        // recuperation du personne et set de son id
        
        $etudiant->setId($this->connexion ->lastInsertId());

        $currentId = $etudiant->getId();
        $tabCours = $etudiant->getCours();
        
        // boucle sur la variable et insertion vers la cours cours ayant pour cle etrangere la table eleveEnseignant
        
        foreach($tabCours as $value){
            $req = $this->connexion 
            ->prepare("INSERT INTO cours (nomCours,idPersonne) VALUES (:nomCours,:idPersonne)");
            $req->bindValue(':nomCours',$value);
            $req->bindValue(':idPersonne',$currentId);
            $req->execute();
        
        }
              
    }
   
    public function readOne($id){
                
        $req =  $this->connexion 
        ->query("SELECT elevesEnseignant.id,nom,prenom,adresse,cp,pays,societe,statut,niveau,date_entree,anciennete,date_creation
            FROM elevesEnseignant 
            WHERE id=".$id."   
            ORDER BY statut,nom, prenom;" );

        // execution de la requete avec un fetchall qui prend toute les donnees ,fetch ne prends que la 1 ere
        $result = $req->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function readOneCours($id){
                
        $req =  $this->connexion 
        ->query("SELECT nomCours FROM cours 
            WHERE idPersonne =".$id."   
            ORDER BY nomCours; ");

            // execution de la requete avec un fetchall qui prend toute les donnees ,fetch ne prends que la 1 ere
            $result = $req->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
    }
       
    
    public function readAll(){
    
        $req =  $this->connexion 
        ->query("SELECT elevesEnseignant.id,nom,prenom,adresse,cp,pays,societe,statut,niveau,date_entree,anciennete,date_creation
            FROM elevesEnseignant 
            ORDER BY statut ,nom, prenom;" );


        // execution de la requete avec un fetchall qui prend toute les donnees ,fetch ne prends que la 1 ere
        $result = $req->fetchAll(PDO::FETCH_ASSOC);

        return $result;
            
    }
    
    public  function  allDatas($element){
         $tabPersonne = [];
        foreach($element as $value ){
            $cours = $this->readOneCours($value["id"]);
            $lesCours = [];
           foreach($cours as $val){
             $lesCours[] = $val["nomCours"];
           }
            $value["cours"] = $lesCours;
            $tabPersonne[] = $value ;
        }

        return $tabPersonne;

    }
      public  function  update(){}
      public  function  delete(){}
     


 


 }

?>