<?php
   
   namespace Isl\Profils\manager;
   use Isl\Profils\classes\Profil;
   use Faker\Factory;
   use PDO;

    abstract class PersonneManager  implements Profil{
      

          abstract public function  create($element);
          abstract public function  read();
          abstract public function update();
          abstract public function delete();
          abstract function monProfil();
 
       

          /*  protected function readOne($id){
                
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
                  
            }*/

    }

?>