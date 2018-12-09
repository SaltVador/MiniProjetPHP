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
 			<link rel="stylesheet" type="text/css" href="./vue/vue.css" media="all"/>
 		</head>
 		<body >

        <h1 style="text-align:center;color:darkblue;text-decoration:underline;">Jeux des ponts</h1>
        <div class="bouton">
        <form action="index.php" method="post">
            <input type="text" hidden name="lien" value="<?php echo $_POST["lien"];?>">
            <input type="text" hidden name="rollB" value="rollb">
            <input type="submit" value="Annuler"<?php if ($c == 1) {echo "disabled";}else{echo "style=\"cursor: pointer\"";}?>>
        </form>
        <form action="index.php" method="post">
            <input type="text" name="lien" value="" hidden>
            <input type="submit" name="reset" value="reset" style="cursor: pointer">
        </form>
        </div>
        <div class="tab">
                <table CELLPADDING="0"  CELLSPACING="0" style="margin: 0px; padding: 0px;">
                <?php
                for ($i=0;$i<7;$i++){
                    echo "<tr style=\"margin: 0px; padding: 0px;\">";
                    for ($j=0;$j<7;$j++){
                        if ($villes->existe($i,$j)){
                            ?>
                                <td style="margin: 0px; padding: 0px;">
                                <form action="index.php" method="post">
                                    <?php

                                    if (!isset($_POST["lien"])){
                                    $_POST["lien"] = "";
                                    }
                                    ?>
                                    <input type="text" hidden name="lien" value="<?php echo $_POST["lien"];?>">
                                    <input type="text" hidden name="ville" value="<?php echo $i."/".$j;?>">
                                    <input type="submit" value="<?php echo $villes->getVille($i,$j)->getNombrePontsMax();?>" style="width: 40px; height: 40px;margin: 0px; padding: 0px; cursor: pointer;<?php if ($c==1&&!strcmp(substr($_POST["lien"],-4,3),$i."/".$j))echo "background-color: cornflowerblue;";?>">
                                </form>
                                </td>
                            <?php
                        } else {
                            ?>
                                <td>
                                <form action="index.php" method="post">
                                <input type="submit" value="<?php echo $ponts[$j][$i]?>" disabled style="width: 40px; height: 40px;margin: 0px; padding: 0px;">
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
        <?php
        if (isset($_POST["fail"])){
            echo "<p style='text-align: center'>Création impossible</p>";
        }
        ?>
        <form action="index.php" method="post" style="display: flex;justify-content: center">
            <input type="submit" name="logout" value="Déconnexion" style="cursor: pointer"/>
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


        <div style="display: flex;justify-content: center;text-align: center">
        <form action="index.php" method="post">
            Pseudo :<br>
            <input type="text" name="pseudo">
            <br>
            <br>
            Mot de passe :<br>
            <input type="password" name="mdp">
            <br>
            <br>
            <input type="radio" name="choixAuth" value="Connexion" checked="checked" id="CO"style="cursor: pointer"><label for="CO"style="cursor: pointer">Connexion</label>
            <br>
            <input type="radio" name="choixAuth" value="Enregistrement" id="EN"style="cursor: pointer"><label for="EN" style="cursor: pointer">Enregistrement</label>
            <br>
            <br>
            <input type="submit" style="cursor: pointer">
            <?php
            if (isset($_POST["coFail"]) && $_POST["coFail"] == true){
                echo "<p style='text-align: center'>Le pseudo et le mot de passe ne correspondent pas</p>";
                echo "<br>";
            }
            if (isset($_POST["enreOK"]) && $_POST["enreOK"] == true){
                echo "<p style='text-align: center'>Vous avez bien été enregistré</p>";
                echo "<br>";
            }if (isset($_POST["enreOK"]) && $_POST["enreOK"] == false){
                echo "<p style='text-align: center'>Ce pseudo est déjà utilisé</p>";
                echo "<br>";
            }
            ?>
        </form>
        </div>
        </body>
        </html>
        <?php
    }

    function bienvenue(){
 	    ?>
        <p style="text-align: center">Bienvenue <?php echo $_POST["pseudo"];?></p>
        <form action="index.php" style="display: flex;justify-content: center">
            <input type="submit" value="OK" style="cursor: pointer">
        </form>
<?php
    }

    function gagne($stat){
 	    ?>
        <p style="text-align: center">Félicitation vous avez gagné</p>
        Vous avez gagné <?php echo $stat[0]." parties sur ".$stat[1];?>
        <form action="index.php" method="post" style="display: flex;justify-content: center;">
            <input type="submit" name="logout" value="Déconnexion" style="cursor: pointer"/>
        </form>
        <?php
    }

    function deco(){
 	    ?>
        <p style="text-align: center;">Vous avez été déconnecté</p>
        <form action="index.php" style="display: flex;justify-content: center;">
            <input type="submit" value="OK" style="cursor: pointer">
        </form>
        <?php
    }


 }