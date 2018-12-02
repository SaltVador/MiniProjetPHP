<?php

require_once PATH_MODELE."/modele.php";
require_once PATH_CONTROLEUR."/controleurAffiche.php";
require_once PATH_CONTROLEUR."/ControleurAuthentification.php";


class Routeur {
	private $modele;
	private $ctrlAffiche;
	

	public function __construct(){
		$this->modele = new Modele();
		$this->ctrlAffiche = new controleurAffiche();
		$this->ctrlAuth = new ControleurAuthentification();
		
	}

	public function routeurRequete()
	{
		$this->ctrlAuth->vueauth();
	}
}