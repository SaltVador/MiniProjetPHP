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
        if (!isset($_POST["lien"]))$_POST["lien"]="";
        parse_str($_POST["lien"],$lien);
        if (isset($lien['ville'])){
            for ($i=1;$i<=count($lien['ville'])-1;$i+=2){
                $ville1=$lien['ville'][$i-1];
                $ville2=$lien['ville'][$i];
            }
        }
    }

}