<?php

require_once PATH_MODELE."/modele.php";
require_once PATH_CONTROLEUR."/controleurAffiche.php";


class Routeur {
	private $modele;
	private $ctrlAffiche;
	

	public function __construct(){
		$this->modele = new Modele();
		$this->ctrlAffiche = new controleurAffiche();
		
	}

	public function routeurRequete()
	{
		$this->ctrlAffiche->affiche();
	}
}