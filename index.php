<?php
session_start();
require "config/config.php";
require PATH_CONTROLEUR."/routeur.php";

$monrout = new Routeur();
$monrout->routeurRequete();