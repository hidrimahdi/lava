
<?php

class Reclamation{//Class
    //ATTRIBUTS
    private ?int $id = null;
    private ?string $details = null;
    private ?string $solutionPreferer = null;
//CONSTRUCTEUR
    function __construct(int $id,string $details,string $solutionPreferer,)
    {

        $this->id=$id;
        $this->details=$details;
        $this->solutionPreferer=$solutionPreferer;
    
    }

//GETTERS AND SETTERS
    //GETTERS

    function getid(): int{
        return $this->id;
    
    }
    
    function getdetails(): string{
        return $this->details;
    
    }
    function getsolutionPreferer(): string{
        return $this->solutionPreferer;
    
    }

    
   
   //SETTERS


   function setid(int $id): void{
    $this->id=$id;
}
    function setdetails(string $details): void{
        $this->details=$details;
    }
    function setsolutionPreferer(string $solutionPreferer): void{
        $this->solutionPreferer=$solutionPreferer;
    }
    
}

?>