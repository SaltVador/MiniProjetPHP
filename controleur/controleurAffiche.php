<?php 

require_once PATH_MODELE."/Villes.php";
require_once PATH_VUE."/vue.php";

class ControleurAffiche 
{
	private $maVue;
	private $villes;
	function __construct()
	{
	
		$this->maVue = new Vue();
		$this->villes = new Villes();

	}

	function affiche(){
		$this->maVue->jeu($this->villes);
	}
}


?>