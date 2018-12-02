<?php

require_once PATH_VUE."/vue.php";

class ControleurAuthentification
{
    private $maVue;
    function __construct()
    {

        $this->maVue = new Vue();
        $this->bd = new Modele();

    }

    function vueauth(){
        $this->maVue->demandePseudo();
    }

    function enregistrement(){
        $this->bd->enregistreBD();
        $this->maVue->demandePseudo();
    }

    function verifCo(){
        if ($this->bd->exists()){
            $this->maVue->jeu();
        } else {
            $_POST["coFail"] = true;
            $this->maVue->demandePseudo();
        }
    }
}