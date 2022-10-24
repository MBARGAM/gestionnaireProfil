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
    public  function  read(){}
    public  function  update(){}
    public  function  delete(){}
    public  function  monProfil(){}
 


 }

?>