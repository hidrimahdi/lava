/<?php
include_once("C:/xampp/htdocs/new/config.php");
include_once("C:/xampp/htdocs/new/Model/Reclamation.php");

class ReclamationC {//nom du class
    function supprimerReclamation($id){
        $sql="DELETE FROM Reclamation WHERE id=:id";
        $db = config::getConnexion();
        $req=$db->prepare($sql);
        $req->bindValue(':id', $id);
        try{
            $req->execute();
        }
        catch(Exception $e){
            die('Erreur:'. $e->getMeesage());
        }
    }
    function afficherReclamation(){
        $sql="select * from Reclamation";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
    }
    catch(Exception $e){
        echo 'Erreur: '.$e->getMessage();
    }
}
function recupererReclamation($id){
    $sql="select * from Reclamation where id=".$id;
    $db = config::getConnexion();
    try{
        $liste = $db->query($sql);
        return $liste;
    }
        
    catch(Exception $e){
        echo 'Erreur: '.$e->getMessage();
}

}

public function ajouterReclamation($Reclamation){//esm lfunction  esm lparametre 
$sql="insert into Reclamation(id,details,solutionPreferer) values(:id,:details,:solutionPreferer)";//esm ettable w esm les attributs ma tansesh deux points
    $db = config::getConnexion();
    try{
        $query=$db->prepare($sql);
        $query->execute([
                      
            //esm lvariable louleni virgule mawjouda dima ken fi ekher star
            

                'id'=>$Reclamation->getid(),                           
                'details'=>$Reclamation->getdetails(),
                'solutionPreferer'=>$Reclamation->getsolutionPreferer(),
                

       
        
        ]);
        
    }
        catch(Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }
}
public function modifierReclamation($Reclamation,$id){//esm lfunction  esm lparametre 
    $sql="update Reclamation set id=:id,details=:details,solutionPreferer=:solutionPreferer where id=".$id;//esm ettable w esm les attributs ma tansesh deux points
        $db = config::getConnexion();
        try{
            $query=$db->prepare($sql);
            $query->execute([
                                                                  //esm lvariable louleni virgule mawjouda dima ken fi ekher star
            'id'=>$Reclamation->getid(),                           
            'details'=>$Reclamation->getdetails(),
            'solutionPreferer'=>$Reclamation->getMessage(),
          
            
            ]);
            
        }
            catch(Exception $e){
                echo 'Erreur: '.$e->getMessage();
            }
    }
    


}

?>