<?php 

require_once PATH_MODELE."/Villes.php";
require_once PATH_VUE."/vue.php";

class ControleurAffiche 
{
	private $maVue;
	function __construct()
	{
	
		$this->maVue = new Vue();

	}

	function affiche(){
		if ($_SESSION["villes"] == null) {
 			$_SESSION["villes"] = new Villes();
 		}

		$this->maVue->jeu();
	}
}


?>