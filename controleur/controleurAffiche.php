<?php

require_once PATH_MODELE."/Villes.php";
require_once PATH_VUE."/vue.php";
require_once PATH_MODELE."/modele.php";

class ControleurAffiche
{
    private $maVue;
    private $mod;
    function __construct()
    {

        $this->maVue = new Vue();
        $this->mod = new Modele();

    }

    function affiche($villes,$ponts,$c){

        for ($i=0;$i<7;$i++){
            for ($j=0;$j<7;$j++){
                if ($villes->existe($i,$j)){
                    if ($villes->getVille($i,$j)->getNombrePonts()==$villes->getVille($i,$j)->getNombrePontsMax()){
                        $verif[$villes->getVille($i,$j)->getId()] = true;
                    } else $verif[$villes->getVille($i,$j)->getId()] = false;
                }
            }
        }
        $var = true;
        foreach ($verif as $index){
            if ($index==false){
                $var = false;
            }
        }
        if ($var==false){
            $this->maVue->jeu($villes,$ponts,$c);
        } else{
            $this->mod->gagne();
            $this->maVue->gagne($this->mod->statFin());
        }

    }
    function deco(){
        $this->maVue->deco();
    }
}


?>