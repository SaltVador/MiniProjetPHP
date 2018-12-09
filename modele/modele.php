<?php


// Classe generale de definition d'exception
class MonException extends Exception{
  private $chaine;
  public function __construct($chaine){
    $this->chaine=$chaine;
  }

  public function afficher(){
    return $this->chaine;
  }

}


// Exception relative à un probleme de connexion
class ConnexionException extends MonException{
}

// Exception relative à un probleme d'accès à une table
class TableAccesException extends MonException{
}


// Classe qui gère les accès à la base de données

class Modele{
private $connexion;
private $villes;

// Constructeur de la classe

  public function __construct(){
   try{  
   
    
    $chaine="mysql:host=".HOST.";dbname=".BD;
    $this->connexion = new PDO($chaine,LOGIN,PASSWORD);
    $this->connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $this->villes = new Villes();
     }
    catch(PDOException $e){
      $exception=new ConnexionException("problème de connexion à la base");
      throw $exception;
    }
  }




// A développer
// méthode qui permet de se deconnecter de la base
public function deconnexion(){
   $this->connexion=null;
}

    public function exists(){
        try{
            $statement = $this->connexion->prepare("select pseudo from joueurs where pseudo=? and motDePasse=?;");
            $statement->bindParam(1, $pseudoParam);
            $statement->bindParam(2, $mdpParam);
            $pseudoParam=$_POST["pseudo"];
            $mdpParam=crypt($_POST["mdp"],"SaltVador");
            $statement->execute();
            $result=$statement->fetch(PDO::FETCH_ASSOC);

            if ($result["pseudo"]!=NUll){
                return true;
            }
            else{
                return false;
            }
        }
        catch(PDOException $e){
        }
    }

    public function enregistreBD(){
        try{
            $statement = $this->connexion->prepare("insert into joueurs values (?,?)");
            $statement->bindParam(1, $pseudoParam);
            $statement->bindParam(2, $mdpParam);
            $pseudoParam=$_POST["pseudo"];
            $mdpParam=crypt($_POST["mdp"],"SaltVador");
            $statement->execute();
            $_POST["enreOK"]=true;
        }
        catch(PDOException $e){
            $_POST["enreOK"]=false;
        }
    }

    function creaP(){
        try{
            $statement = $this->connexion->prepare("INSERT INTO `parties` (`id`, `pseudo`, `partieGagnee`) VALUES (NULL, ?, '0')");
            $pseudoParam=$_SESSION["login"];
            $statement->bindParam(1, $pseudoParam);
            $statement->execute();

        }
        catch(PDOException $e){
            throw new TableAccesException("erreur création partie");
        }
    }

    function gagne(){
        try{
            $statement = $this->connexion->prepare("SELECT id FROM `parties` WHERE pseudo=?");
            $pseudoParam=$_SESSION["login"];
            $statement->bindParam(1, $pseudoParam);
            $statement->execute();
            while($ligne=$statement->fetch()){
                $result[]=$ligne['id'];
            }
            $id=$result[count($result)-1];
            $statement = $this->connexion->query("UPDATE `parties` SET `partieGagnee` = '1' WHERE `parties`.`id` = ".$id);
        }catch (PDOException $e){

        }
    }

    function statFin(){
        $statement = $this->connexion->query("SELECT COUNT(id) FROM `parties` WHERE pseudo=\"".$_SESSION["login"]."\" and partieGagnee=1");
        $ligne=$statement->fetch();
        $result[0]=$ligne['COUNT(id)'];
        $statement = $this->connexion->query("SELECT COUNT(id) FROM `parties` WHERE pseudo=\"".$_SESSION["login"]."\"");
        $ligne=$statement->fetch();
        $result[1]=$ligne['COUNT(id)'];
        return $result;
    }
}

?>

