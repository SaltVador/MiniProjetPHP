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

    function creerVilles(){
      try{
          for($i = 0; $i<7; $i++) {
              for ($j = 0; $j < 7; $j++) {
                  if ($this->villes->existe($i,$j)) {
                      for ($x = 0; $x < 7; $x++) {
                          if ($x != $j && $this->villes->existe($i,$x)) {

                              $statement = $this->connexion->prepare("insert into lienvilles values (?,?,?,0);");
                              $statement->bindParam(1, $_SESSION["login"]);
                              $ville1 = "".$i.$j;
                              $statement->bindParam(2, $ville1);
                              $ville2 = "".$i.$x;

                              $statement->bindParam(3, $ville2);
                              $statement->execute();

                          }
                      }
                      for ($y = 0; $y < 7; $y++) {
                          if ($y != $i && $this->villes->existe($y,$j)) {

                              $statement = $this->connexion->prepare("insert into lienvilles values (?,?,?,0);");
                              $statement->bindParam(1, $_SESSION["login"]);
                              $ville1 ="".$i.$j;
                              $statement->bindParam(2, $ville1);
                              $ville2 ="".$y.$j;
                              $statement->bindParam(3, $ville2);
                              $statement->execute();

                          }
                      }
                  }
              }
          }
      }


      catch (PDOException $e){
        throw new TableAccesException("ta mere");
      }
    }


}

?>

