<?php 
  include_once("function.php");
  require_once("vendor/autoload.php");
   use Isl\Profils\classes\Personne;
   use Isl\Profils\classes\Etudiant;
   use Isl\Profils\classes\Enseignant;
   use Isl\Profils\manager\EtudiantManager;
   use Isl\Profils\manager\EnseignantManager;

   try{
        $nbre = 6;
        $connexion = new PDO('mysql:host=localhost;dbname=webDev3','root','root');
        $managerEtudiant = new EtudiantManager($connexion); //instanciation de la classe etudiant manager
        $managerEnseignant = new EnseignantManager($connexion); //instanciation de la classe enseignant manager
        
      /*  for( $i = 0 ;$i< $nbre ; $i++){

            //insertion des etudiants
           $data =[];
            $data= ["coursSuivis"=>Personne::createCours(2),"infoPerso"=>Personne::createPersonne()[0]];
            $newEtudiant = new Etudiant($data);
            $managerEtudiant->create($newEtudiant);

            // insertion des enseignants
            $data =[];
            $data= ["coursDispenses"=>Personne::createCours(2),"infoPerso"=>Personne::createPersonne()[0]];
            $newEnseignant = new Enseignant($data);
            print_q($newEnseignant);
            $managerEnseignant->create($newEnseignant);

         } */
    }catch(PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
    

?>