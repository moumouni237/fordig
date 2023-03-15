<?php
// Vérification que le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Récupération des données du formulaire
	$titre = $_POST["titre"];
	$categorie = $_POST["categorie"];
	$date_debut = $_POST["date_debut"];
	$date_fin = $_POST["date_fin"];
	$contenu = $_POST["contenu"];

	// Traitement de l'image
	$image = $_FILES["image"]["name"];
	$target_dir = "images/";
	$target_file = $target_dir . basename($image);
	move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    // Connexion à la base de données
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "fordig";

	$conn = new mysqli($servername, $username, $password, $dbname);

	// Vérification de la connexion
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
    // Insertion des données dans la base de données
	$sql = "INSERT INTO articles (titre, categorie, date_debut, date_fin, image, contenu) VALUES ('$titre', '$categorie', '$date_debut', '$date_fin', '$image', '$contenu')";

	if ($conn->query($sql) === TRUE) {
	    //	echo "L'article a été publié avec succès.";
        header('Location: index.php');
	} else {
		echo "Erreur : " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}
?>