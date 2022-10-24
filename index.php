<?php 
  include_once("function.php");
  require_once("vendor/autoload.php");
   use Isl\Profils\classes\Personne;
   use Isl\Profils\classes\Etudiant;
   use Isl\Profils\classes\Enseignant;
 
 
   $infos = Enseignant::createPersonne(1);
   print_q($infos);
   $data= ["coursSuivis"=>["geo","hist"],"niveau"=>1,"dateInscription"=>"2022-10-10","statut"=>"eleve","infoPerso"=> $infos[0] ];
   
   $data1= ["coursSuivis"=>["geo","hist"],"dateEntree"=>"1987-10-10","infoPerso"=> $infos[0]];

   
   $newEnseignant= new Enseignant($data1);

   $newEnseignant->setAnciennete($newEnseignant->anciennete());

    print_q($newEnseignant);

?>