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
		$this->maVue->jeu();
	}
}


?>