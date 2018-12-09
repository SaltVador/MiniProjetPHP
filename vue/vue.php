<?php

 
 class Vue
 {


 	
 	function jeu($villes,$ponts,$c)
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
                for ($i=0;$i<7;$i++){
                    echo "<tr>";
                    for ($j=0;$j<7;$j++){
                        if ($villes->existe($i,$j)){
                            ?>
                                <td>
                                <form action="index.php" method="post">
                                    <?php

                                    if (!isset($_POST["lien"])){
                                    $_POST["lien"] = "";
                                    }
                                    ?>
                                    <input type="text" hidden name="lien" value="<?php echo $_POST["lien"];?>">
                                    <input type="text" hidden name="ville" value="<?php echo $i."/".$j;?>">
                                    <input type="submit" value="<?php echo $villes->getVille($i,$j)->getNombrePontsMax();?>" style="width: 40px; height: 40px;">
                                </form>
                                </td>
                            <?php
                        } else {
                            ?>
                                <td>
                                <form action="index.php" method="post">
                                <input type="submit" value="<?php echo $ponts[$j][$i]?>" disabled style="width: 40px; height: 40px;">
                                </form>
                                </td>
                            <?php
                        }
                    }
                    echo "</tr>";
                }
                ?>
                </table>
                <form action="index.php" method="post">
                    <input type="text" hidden name="lien" value="<?php echo $_POST["lien"];?>">
                    <input type="text" hidden name="rollB" value="rollb">
                    <input type="submit" value="Annuler le dernier lien créé"<?php if ($c == 1) echo "disabled";?>>
                </form>
 			</div>
        <form action="index.php" method="post">
            <input type="text" name="lien" value="" hidden>
            <input type="submit" name="reset" value="reset">
        </form>

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

    function gagne(){
 	    echo "Gagne";
    }
 }