<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fordig_Tech</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
             <a href="logout.php">Déconnexion</a>
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Liste des publications</p>

                <?php
                // Connexion à la base de données
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "fordig";

                $conn = new mysqli($servername, $username, $password, $dbname);

                // Vérifier la connexion
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                // Vérifier si un article doit être supprimé
                if(isset($_POST['supprimer'])) {
                    $id = $_POST['id'];
                    $sql = "DELETE FROM articles WHERE id=".$id;
                    if ($conn->query($sql) === TRUE) {
                    echo "L'article a été supprimé avec succès.";
                    } else {
                    echo "Erreur lors de la suppression de l'article: " . $conn->error;
                    }
                }
                                // Vérifier si un article doit être modifié
                if(isset($_POST['modifier'])) {
                    $id = $_POST['id'];
                    $titre = $_POST['titre'];
                    $contenu = $_POST['contenu'];
                    $sql = "UPDATE articles SET titre='".$titre."', contenu='".$contenu."' WHERE id=".$id;
                    if ($conn->query($sql) === TRUE) {
                    echo "L'article a été modifié avec succès.";
                    } else {
                    echo "Erreur lors de la modification de l'article: " . $conn->error;
                    }
                }

                                    // Récupérer les articles de la base de données
                    $sql = "SELECT *  FROM articles";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                    // Afficher chaque article sous forme de formulaire avec des boutons pour supprimer ou modifier l'article
                    while($row = $result->fetch_assoc()) {
                        echo "<form method='post'>
                        <input type='hidden' name='id' value='".$row["id"]."'>
                        <input type='text' name='titre' value='".$row["titre"]."'>
                        <input type='text' name='categorie' value='".$row["categorie"]."'>
                        <input type='text' name='date_debut' value='".$row["date_debut"]."'>
                        <input type='text' name='date_fin' value='".$row["date_fin"]."'>
                        <input type='file' name='image' accept='image/*' value='".$row["image"]."'>
                        <textarea name='contenu'>".$row["contenu"]."</textarea>
                        <input type='submit' name='modifier' value='Modifier'> 
                        / <input type='submit' name='supprimer' value='Supprimer'>
                        </form>";
                    }
                    } else {
                    echo "Aucun article trouvé.";
                    }

                    $conn->close();

                ?>


              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="img/authentification.jpg"
                  class="img-fluid" alt="Sample image">
                  

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/isotope/isotope.pkgd.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>