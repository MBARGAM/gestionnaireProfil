<?php 
  include_once("function.php");
  require_once("vendor/autoload.php");
   use Isl\Profils\classes\Personne;
   use Isl\Profils\classes\Etudiant;
   use Isl\Profils\classes\Enseignant;
   use Isl\Profils\manager\EtudiantManager;
   use Isl\Profils\manager\EnseignantManager;
   use Isl\Profils\manager\PersonneManager;

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

         $tabAll =  $managerEtudiant->readAll();
    
        // print_q($managerEtudiant->allDatas($tabAll));

         $tabComplet = $managerEtudiant->allDatas($tabAll);
        
         $tabComplet = array_chunk($tabComplet,3,true);

        // print_q($tabComplet);


    }catch(PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Document</title>
    </head>
    <body>
           <h1 class="text-center mb-5">Liste des elèves et professeurs</h1>
        <?php 
           foreach($tabComplet as $value){
              ?>
                <div class="d-flex justify-content-around ">
                    <?php 
                      
                          foreach($value as $data){
                    ?>   
                        <div class="border border-secondary mb-5 mx-3 bg-light w-100">
                            <div class="d-flex" >
                                <div>
                                      <img src ="src/images/pic.jpeg" class="img-thumbnail border border-secondary" alt="Responsive image">
                                </div>
                                <div class="p-3 ">
                                    <div class="d-flex"><span class="d-block font-weight-bold">Nom   &nbsp&nbsp </span><span class="d-block" ><?php echo " : ".$data["nom"];?></span></div>
                                    <div class="d-flex"><span class="d-block font-weight-bold">Prénom &nbsp&nbsp </span><span class="d-block" ><?php echo " : ".$data["prenom"];?></span></div>
                                    <div class="d-flex"><span class="d-block font-weight-bold">Adresse  &nbsp&nbsp </span><span class="d-block" ><?php echo " : ".$data["adresse"];?></span></div>
                                    <div class="d-flex"><span class="d-block font-weight-bold">Cp &nbsp&nbsp </span><span class="d-block" ><?php echo " : ".$data["cp"];?></span></div>
                                    <div class="d-flex"><span class="d-block font-weight-bold">Pays &nbsp&nbsp </span><span class="d-block" ><?php echo " : ".$data["pays"];?></span></div>
                                    <div class="d-flex"><span class="d-block font-weight-bold">Statut &nbsp&nbsp </span><span class="d-block" ><?php echo " : ".ucfirst($data["statut"]);?></span></div>
                                    <div class="d-flex"><span class="d-block font-weight-bold">Société &nbsp&nbsp  </span><span class="d-block" ><?php echo " : ".$data["societe"];?></span></div>
                                    <div class="d-flex"><span class="d-block font-weight-bold"><?php echo $data["statut"]=="eleve"? " Niveau ":" Ancienneté " ;?> &nbsp&nbsp  </span><span class="d-block" ><?php echo $data["statut"]=="eleve"? " : ".$data["niveau"]: " : ".$data["anciennete"]." ans" ;?></span></div>
                                    <div class="d-flex"><span class="d-block font-weight-bold"><?php echo $data["statut"]=="eleve"? " Date inscription ":" Date Entrée " ;?> &nbsp&nbsp  </span><span class="d-block" ><?php echo " : ".$data["date_entree"] ;?></span></div>
                                    
                                </div>
                                   
                            </div>
                            <div class="border-top border-secondary ">
                                <h6 class="text-center font-weight-bold"><?php echo $data["statut"]=="eleve"? " Cours suivis " : " Cours dispensés" ;?></h6> 
                                <ol>
                                <?php
                                
                                    foreach ($data["cours"] as $key=>$value){
                                        ?>                                    
                                              <li><?php echo $value ;?></li>
                                          
                                        <?php
                                    }
                                
                                ?>
                                </ol>
                            </div>
                        </div>

                     <?php
                          }
                     
                    ?>
                
                </div>      
        <?php
           }
        
        
        ?>
        
    </body>
    </html>
    
