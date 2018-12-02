<?php

require_once PATH_VUE."/vue.php";

class ControleurAuthentification
{
    private $maVue;
    function __construct()
    {

        $this->maVue = new Vue();

    }

    function vueauth(){
        $this->maVue->demandePseudo();
}
}