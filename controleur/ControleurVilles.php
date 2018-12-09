<?php
require_once PATH_MODELE."/Villes.php";
require_once PATH_MODELE."/modele.php";
require_once PATH_VUE."/vue.php";

class ControleurVilles
{

    private $modele;
    private $villes;
    private $maVue;

    function __construct()
    {
        $this->villes = new Villes();
        $this->modele = new Modele();
        $this->maVue = new Vue();

    }

    function init(){

        for ($i=0;$i<7;$i++){
            for ($j=0;$j<7;$j++){
                $ponts[$i][$j]="";
            }
        }
        if (!isset($_POST["lien"])){
            $_POST["lien"] = "";
        }

        if (isset($_POST["ville"])){
            $_POST["ville"] = "ville[]=".$_POST["ville"];
            $_POST["lien"] = $_POST["lien"].$_POST["ville"]."&";
        }


        if (!isset($_POST["lien"]))$_POST["lien"]="";

        parse_str($_POST["lien"],$lien);
        $count = 1;
        if (isset($lien['ville'])){
            $count = count($lien['ville'])%2;
            for ($e=1;$e<count($lien['ville']);$e=$e+2){

                $ville1=$lien['ville'][$e-1];
                $ville2=$lien['ville'][$e];
                $ville1b = explode("/",$ville1);
                $ville1i = $ville1b[0];
                $ville1j = $ville1b[1];
                $ville2b = explode("/",$ville2);
                $ville2i = $ville2b[0];
                $ville2j = $ville2b[1];
                if (($ville1i==$ville2i||$ville1j==$ville2j)&&$ville1!=$ville2){
                    $ville1 = $this->villes->getVille($ville1i,$ville1j);
                    $ville2 = $this->villes->getVille($ville2i,$ville2j);
                    $pont = $this->villes->getVille($ville1i,$ville1j)->getNombrePVille($this->villes->getVille($ville2i,$ville2j));
                    if ($pont<2) {
                        if ($this->noCollision($ville1i,$ville1j,$ville2i,$ville2j)){
                            $this->villes->getVille($ville2i,$ville2j)->addBridge($ville1);
                            $this->villes->getVille($ville1i,$ville1j)->addBridge($ville2);
                        }else $this->rollback();
                    }else {
                        $this->villes->getVille($ville2i,$ville2j)->delBridge($ville1);
                        $this->villes->getVille($ville1i,$ville1j)->delBridge($ville2);
                    }
                    $pont = $this->villes->getVille($ville1i,$ville1j)->getNombrePVille($this->villes->getVille($ville2i,$ville2j));
                    if ($ville2i==$ville1i){
                        if ($ville1j>$ville2j){
                            for ($i = $ville2j+1;$i<$ville1j;$i++){
                                if ($pont == 0){
                                    $ponts[$i][$ville1i] = "";
                                }
                                if ($pont == 1){
                                    $ponts[$i][$ville1i] = "-";
                                }
                                if ($pont == 2){
                                    $ponts[$i][$ville1i] = "=";
                                }
                            }
                        }else{
                            for ($i = $ville1j+1;$i<$ville2j;$i++){
                                if ($pont == 0){
                                    $ponts[$i][$ville1i] = "";
                                }
                                if ($pont == 1){
                                    $ponts[$i][$ville1i] = "-";
                                }
                                if ($pont == 2){
                                    $ponts[$i][$ville1i] = "=";
                                }
                            }
                        }
                    } else{
                        if ($ville1i>$ville2i){
                            for ($i = $ville2i+1;$i<$ville1i;$i++){
                                if ($pont == 0){
                                    $ponts[$ville1j][$i] = "";
                                }
                                if ($pont == 1){
                                    $ponts[$ville1j][$i] = "|";
                                }
                                if ($pont == 2){
                                    $ponts[$ville1j][$i] = "||";
                                }
                            }
                        }else{
                            for ($i = $ville1i+1;$i<$ville2i;$i++){
                                if ($pont == 0){
                                    $ponts[$ville1j][$i] = "";
                                }
                                if ($pont == 1){
                                    $ponts[$ville1j][$i] = "|";
                                }
                                if ($pont == 2){
                                    $ponts[$ville1j][$i] = "||";
                                }
                            }
                        }
                    }
                } else $this->rollback();
            }
        }
        $resultat[0] = $this->villes;
        $resultat[1] = $ponts;
        $resultat[2] = $count;
        return $resultat;
    }

    function rollback()
    {
        $_POST["lien"] = substr($_POST["lien"], 0, strlen($_POST["lien"]) - 24);
        echo "Création impossible";
    }

    function rollback2()
    {
        $_POST["lien"] = substr($_POST["lien"], 0, strlen($_POST["lien"]) - 24);
    }

    function noCollision($ville1i,$ville1j,$ville2i,$ville2j){
        $verif=true;
        if ($ville2i==$ville1i){
            if ($ville1j>$ville2j){
                for ($i = $ville2j+1;$i<$ville1j;$i++){
                    if ($this->villes->existe($ville1i,$i)){
                        $verif= false;
                    }
                }
            }else{
                for ($i = $ville1j+1;$i<$ville2j;$i++){
                    if ($this->villes->existe($ville2i,$i)){
                        $verif= false;
                    }
                }
            }
        } else{
            if ($ville1i>$ville2i){
                for ($i = $ville2i+1;$i<$ville1i;$i++){
                    if ($this->villes->existe($i,$ville2j)){
                        $verif= false;
                    }
                }
            }else{
                for ($i = $ville1i+1;$i<$ville2i;$i++){
                    if ($this->villes->existe($i,$ville2j)){
                        $verif= false;
                    }
                }
            }
        }
        return $verif;
    }


}