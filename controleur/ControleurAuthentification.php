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
            $_SESSION["login"] = $_POST["pseudo"];
            $this->bd->creaP();
            $this->maVue->bienvenue();
        } else {
            $_POST["coFail"] = true;
            $this->maVue->demandePseudo();
        }
    }
}