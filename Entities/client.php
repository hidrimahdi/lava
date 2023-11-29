<?php

class client
{
	private $id;
	private $Sexe;
	private $Nom;
	private $Prenom;
	private $num_tel;
	private $mail;
	private $adresse;
	private $date_anniversaire;
	private $mp;
	
	public function __construct($id,$Sexe,$Nom,$Prenom,$num_tel,$mail,$adresse,$date_anniversaire,$mp)
	
	{
		$this->id=$id;
		$this->Sexe=$Sexe;
		$this->Nom=$Nom;
		$this->Prenom=$Prenom;
		$this->num_tel=$num_tel;
		$this->mail=$mail;
		$this->adresse=$adresse;
		$this->date_anniversaire=$date_anniversaire;
		$this->mp=$mp;
	}
	public function getid(){return $this->id;}
	public function getSexe(){return $this->Sexe;}
	public function getNom(){return $this->Nom;}
	public function getPrenom(){return $this->Prenom;}
	public function getnum_tel(){return $this->num_tel;}
	public function getmail(){return $this->mail;}
	public function getadresse(){return $this->adresse;}
	public function getdate_anniversaire(){return $this->date_anniversaire;}
	public function getmp(){return $this->mp;}
	public function setid($id){$this->id=$id;}
	public function setSexe($Sexe){$this->$Sexe;}
	public function setNom($Nom){$this->Nom=$Nom;}
	public function setPrenom($Prenom){$this->Prenom=$Prenom;}
	public function setnum_tel($num_tel){$this->num_tel=$num_tel;}
	public function setmail($mail){$this->mail=$mail;}
	public function setadresse($adresse){$this->adresse=$adresse;}
	public function setdate_anniversaire($date_anniversaire){$this->date_anniversaire=$date_anniversaire;}
	public function setmp($mp){$this->mp=$mp;}
}
?>