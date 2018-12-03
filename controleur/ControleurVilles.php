<?php
require_once PATH_MODELE."/Villes.php";
require_once PATH_MODELE."/modele.php";

class ControleurVilles
{

    private $modele;

    function __construct()
    {
        $this->villes = new Villes();
        $this->modele = new Modele();
    }

    function init(){
        $this->modele->creerVilles();
        $_SESSION["villesFonde"] = true;
    }

}