
<?php

class Reclamation
{ //Class
    //ATTRIBUTS
    private ?int $id = null;
    private ?string $objet = null;
    private ?string $commentaire = null;
    private ?int $id_user = null;
    //CONSTRUCTEUR
    function __construct(int $id, string $objet, string $commentaire, int $id_user)
    {

        $this->id = $id;
        $this->objet = $objet;
        $this->commentaire = $commentaire;
        $this->id_user = $id_user;
    }

    //GETTERS AND SETTERS
    //GETTERS

    function getid(): int
    {
        return $this->id;
    }
    function getidUser(): int
    {
        return $this->id_user;
    }

    function getobjet(): string
    {
        return $this->objet;
    }
    function getcommentaire(): string
    {
        return $this->commentaire;
    }



    //SETTERS


    function setid(int $id): void
    {
        $this->id = $id;
    }
    function setidUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }
    function setobjet(string $objet): void
    {
        $this->objet = $objet;
    }
    function setcommentaire(string $commentaire): void
    {
        $this->commentaire = $commentaire;
    }
}

?>