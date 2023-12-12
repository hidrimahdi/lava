
<?php

class Reponse{//Class
    //ATTRIBUTS
    private ?int $id = null;
    private ?string $reponse = null;
    private ?int $id_reclamation = null;
//CONSTRUCTEUR
    function __construct(string $reponse,int $id_reclamation)
    {

        
        $this->reponse=$reponse	;
        $this->id_reclamation=$id_reclamation;
    
    }

//GETTERS AND SETTERS
    //GETTERS

    function getid(): int{
        return $this->id;
    
    }
    
    function getreponse(): string{
        return $this->reponse	;
    
    }
    function getIdReclamation(): int{
        return $this->id_reclamation;
    }

    
   
   //SETTERS


   function setid(int $id): void{
    $this->id=$id;
}

    function setreponse(string $reponse	): void{
        $this->reponse=$reponse	;
    }
    function setIdrRclamation(int $id_reclamation): void{
        $this->id_reclamation=$id_reclamation;
    }
    
}

?>