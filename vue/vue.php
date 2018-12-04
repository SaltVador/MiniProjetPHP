<?php

 
 class Vue
 {


 	
 	function jeu($villes)
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
                <table>

                <?php
                #$_POST["villes"] += $_POST["ville"];
                for ($i=0;$i<7;$i++){
                    echo "<tr>";
                    for ($j=0;$j<7;$j++){
                        if ($villes->existe($i,$j)){
                            ?>
                                <td>
                                <form action="index.php" method="post">
                                    <input type="text" hidden name="ville" value="<?php echo $i."/".$j;?>">
                                    <input type="submit" value="<?php echo $villes->getVille($i,$j)->getNombrePontsMax();?>" class="bout" style="width: 40px; height: 40px;">
                                </form>
                                </td>
                            <?php
                        } else {
                            ?>
                                <td>
                                <form action="index.php" method="post">
                                <input type="submit" value="" disabled class="bout" style="width: 40px; height: 40px;">
                                </form>
                                </td>
                            <?php
                        }
                    }
                    echo "</tr>";
                }
                ?>
                </table>
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
            <input type="password" name="mdp">
            <br>
            <br>
            <input type="radio" name="choixAuth" value="Connexion" checked="checked" id="CO"><label for="CO">Connexion</label>
            <br>
            <input type="radio" name="choixAuth" value="Enregistrement" id="EN"><label for="EN">Enregistrement</label>
            <br>
            <br>
            <input type="submit">
        </form>

        </body>
        </html>
        <?php
    }

    function bienvenue(){
 	    ?>
        <html>
        Bienvenue <?php echo $_POST["pseudo"];?>
        <br>
        <form action="index.php">
            <input type="submit" value="OK">
        </form>
        </html>
<?php
    }
 }