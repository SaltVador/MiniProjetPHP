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
                $ville1b = explode("/",$ville1);
                $ville1i = $ville1b[0];
                $ville1j=$ville1b[1];
                $ville2b = explode("/",$ville2);
                $ville2i = $ville2b[0];
                $ville2j=$ville2b[1];

            }
        }
    }

}