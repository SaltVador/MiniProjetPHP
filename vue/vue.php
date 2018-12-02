<?php

//require_once PATH_MODELE."/Villes.php";
 
 class Vue
 {


 	
 	function jeu()
 	{	

 		
 		?>
 		<html>
 		<head>
 			<meta charset="UTF-8">
 			<meta content="html/text">
 			<link rel="stylesheet" type="text/css" href="vue.css" media="all"/>
 		</head>
 		<body>
 		
 			<div class="grid">
            Moi
 			</div>

 		</body>
 		</html>
 		<?php
 	}

 	function demandePseudo(){
        ?>
        <html>
        <head>
            <meta title="Auth">
            <meta charset="UTF-8">
            <meta content="html/text">
            <link rel="stylesheet" type="text/css" href="vue.css" media="all"/>
        </head>
        <body>

        <?php
        if (isset($_POST["coFail"]) && $_POST["coFail"] == true){
            echo "<p>Le pseudo et le mot de passe ne correspondent pas</p>";
            echo "<br>";
        }
        if (isset($_POST["enreOK"]) && $_POST["enreOK"] == true){
            echo "<p>Vous avez bien été enregistré</p>";
            echo "<br>";
        }if (isset($_POST["enreOK"]) && $_POST["enreOK"] == false){
            echo "<p>Ce pseudo est déjà utilisé</p>";
            echo "<br>";
        }
        ?>

        <form action="index.php" method="post">
            Pseudo :<br>
            <input type="text" name="pseudo">
            <br>
            <br>
            Mot de passe :<br>
            <input type="text" name="mdp">
            <br>
            <br>
            <input type="radio" name="choixAuth" value="Connexion" checked="checked" id="CO"><label for="CO">Connexion</label>
            <br>
            <input type="radio" name="choixAuth" value="Enregistrement" id="EN"><label for="EN">Enregistremet</label>
            <br>
            <br>
            <input type="submit">
        </form>

        </body>
        </html>
        <?php
    }
 }