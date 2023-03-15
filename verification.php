<?php
  session_start();


if(!isset($_POST['username']) || !isset($_POST['password'])){
    header('Location: login.php');
}
    // connexion à la base de données
try{
$bdd = new PDO('mysql:host=localhost;dbname=fordig', 'root', '');
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}
$username= $_POST["username"];
$password= $_POST["password"];

// on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
// pour éliminer toute attaque de type injection SQL et XSS
$username = htmlspecialchars($_POST['username']); 
$password = htmlspecialchars($_POST['password']);

    
if(empty($username) || empty($password))header('Location: login.php?erreur=2');

$exec=$bdd->query("SELECT count(*) AS cnt FROM utilisateur
WHERE nom_utilisateur='$username' AND mot_de_passe='$password'");
echo "here";
while($reponse=$exec->fetch()){
    $count = $reponse['cnt'];
    if($count!=0) // nom d'utilisateur et mot de passe correctes
    {
        $_SESSION['username']=$username;
        header('Location: menu.php');
    }
    else
    {
        header('Location: administrateur.php?erreur=1');  // utilisateur ou mot de passe incorrect
    }
}

mysqli_close($bdd); // fermer la connexion



/*if(isset($_POST['username']) && isset($_POST['password']))
{
    // connexion à la base de données
    try
{
$bdd = new PDO('mysql:host=localhost;dbname=lafi', 'root', '');
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}
$username= $_POST["username"];
    $pass= $_POST["password"];

$reponse = $bdd->query  ("SELECT  count(*) FROM utilisateur where 
nom_utilisateur = '".$username."' and mot_de_passe = '".$password."' ");

while ($donnees = $reponse->fetch())
{

   echo "b";
}
$reponse->closeCursor();
*/

?>