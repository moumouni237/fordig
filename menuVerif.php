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
	list($width, $height) = getimagesize($target_file);

// Définition des nouvelles dimensions
	$max_width = 800;
	$max_height = 600;
	if ($width > $max_width || $height > $max_height) {
		// Calcul des nouvelles dimensions tout en conservant le ratio
		$ratio = min($max_width/$width, $max_height/$height);
		$new_width = round($width * $ratio);
		$new_height = round($height * $ratio);
	
		// Création d'une image vide avec les nouvelles dimensions
		$new_image = imagecreatetruecolor($new_width, $new_height);
	
		// Chargement de l'image originale
		$source_image = imagecreatefromstring(file_get_contents($target_file));
	
		// Redimensionnement de l'image
		imagecopyresampled($new_image, $source_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	
		// Enregistrement de la nouvelle image
		imagejpeg($new_image, $target_file, 80);
		 // Libération de la mémoire
		 imagedestroy($new_image);
		 imagedestroy($source_image);
	}
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