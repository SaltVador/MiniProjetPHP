<?php

require_once PATH_MODELE."/modele.php";
require_once PATH_CONTROLEUR."/controleurAffiche.php";
require_once PATH_CONTROLEUR."/ControleurAuthentification.php";
require_once PATH_CONTROLEUR."/ControleurVilles.php";


class Routeur {
	private $modele;
	private $ctrlAffiche;
	private $ctrlAuth;
	private $ctrlVilles;
	

	public function __construct(){
		$this->modele = new Modele();
		$this->ctrlAffiche = new controleurAffiche();
		$this->ctrlAuth = new ControleurAuthentification();
		$this->ctrlVilles = new ControleurVilles();

		
	}

	public function routeurRequete()
	{
	    if (isset($_POST["logout"])){
	        session_destroy();
	        $this->ctrlAffiche->deco();
        }else {
            if (isset($_POST["choixAuth"])) {
                if ($_POST["choixAuth"] == "Enregistrement") {
                    $this->ctrlAuth->enregistrement();
                } else {

                    $this->ctrlAuth->verifCo();

                }
            } else {
                if (isset($_SESSION["login"])) {
                    if (isset($_POST["rollB"])) $this->ctrlVilles->rollback2();
                    $param = $this->ctrlVilles->init();
                    $this->ctrlAffiche->affiche($param[0], $param[1], $param[2]);
                } else {
                    $this->ctrlAuth->vueauth();
                }
            }
        }
	}
}