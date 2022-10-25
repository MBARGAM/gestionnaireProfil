<?php 

 namespace Isl\Profils\manager ;
 use Isl\Profils\classes\Enseignant ;

 use PDO ;


 class EnseignantManager extends PersonneManager {

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

    
    public  function  create($enseignant){
        /*insertion des  valeurs generales  dans la table elevesEnseignant
       et on termine  avec l insertion via la table cours*/
    
    
       $req = $this->connexion 
       ->prepare("INSERT INTO elevesEnseignant (nom,prenom,adresse,cp,pays,societe,statut,date_entree,anciennete ) 
       VALUES (:nom,:prenom,:adresse,:cp,:pays,:societe,:statut,:date_entree,:anciennete)");

      $req->bindValue(':nom',$enseignant->getNom());
      $req->bindValue(':prenom',$enseignant->getPrenom());
      $req->bindValue(':adresse',$enseignant->getAdresse());
      $req->bindValue(':cp',$enseignant->getCp());
      $req->bindValue(':pays',$enseignant->getPays());
      $req->bindValue(':societe',$enseignant->getSociete());
      $req->bindValue(':statut',$enseignant->getStatut());
      $req->bindValue(':date_entree',$enseignant-> getDateEntree()->format('Y-m-j'));
      $req->bindValue(':anciennete',$enseignant->getAnciennete());
      $req->execute();

      // recuperation du personne et set de son id
     
      $enseignant->setId($this->connexion ->lastInsertId());

      $currentId = $enseignant->getId();
      $tabCours = $enseignant->getCoursDispenses();
       
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
    
public function readAll(){

    $req =  $this->connexion 
    ->query("SELECT elevesEnseignant.id,nom,prenom,adresse,cp,pays,societe,statut,niveau,date_entree,anciennete,date_creation
        FROM elevesEnseignant 
        ORDER BY statut ,nom, prenom;" );


    // execution de la requete avec un fetchall qui prend toute les donnees ,fetch ne prends que la 1 ere
    $result = $req->fetchAll(PDO::FETCH_ASSOC);

    return $result;
        
}
    public  function  update(){}
    public  function  delete(){}
    public  function  allDatas($element){}
 


 }

?>