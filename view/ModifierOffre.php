<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier votre offre d'alternance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/styleformOffre.css">
 
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>

<body>



    <?php
    if (!isset($_SESSION['id_entreprise'])) {
        header("location:/geii/view/index.php");
        exit();
    }
    include_once 'header.php'
    ?>



    <div class="container">
        <h1>Modifier votre offre d'alternance</h1>

        <form class="form-example" action="ModifierOffreBD.php" method="post">
            <?php
            echo "<div class='input-group mb-3'>\n";
            echo "<select name='id' id='id' class='form-select'>\n";
            echo "<option selected disabled>Vos offres</option>\n";

            try {
                $host = "localhost";
                $dbname = "id20742082_geii";
                $user = "root";
                $pass = "";

                $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("SELECT id_offre, titre_offre FROM offre_alternance WHERE id_entreprise = :id_entreprise");
                $stmt->bindParam(':id_entreprise', $_SESSION['id_entreprise']);
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $selected = '';

                    // Vérification si l'identifiant de l'offre correspond à celui passé en paramètre
                    if (isset($_GET['id'])  == $row['id_offre']) {
                        $selected = 'selected';
                    }

                    echo "<option value='" . $row['id_offre'] . "' $selected>" . $row['titre_offre'] . "</option>\n";
                }

                $conn = null;
            } catch (PDOException $e) {
                echo "Erreur de connexion à la base de données : " . $e->getMessage();
            }

            echo "</select>\n";
            echo "</div>\n";
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="titre">Titre du poste :</label>
                        <input class="form-control" id="titre" name="titre" type="text" placeholder="Entrez le titre du poste" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lieu">Lieu :</label>
                        <input class="form-control" id="lieu" name="lieu" type="text" placeholder="Entrez le lieu" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="contrat">Type de contrat :</label>
                        <select class="form-control" id="contrat" name="contrat" required>
                            <option value="">-- Sélectionner un type de contrat --</option>
                            <option value="Alternance">Alternance</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date_limite">Date limite de candidature :</label>
                        <input class="form-control" id="date_limite" name="date_limite" type="date" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description du poste :</label>
                        <textarea id="description" name="description" class="form-control" rows="5" placeholder="Entrez la description du poste" required></textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="competences">Compétences requises :</label>
                        <input class="form-control" id="competences" name="competences" type="text" placeholder="Entrez les compétences requises" required>
                    </div>
                </div>



                <div class="col-md-6">
                    <div class="form-group">
                        <label for="remuneration">Rémunération :</label>
                        <input class="form-control" id="remuneration" name="remuneration" type="text" placeholder="Entrez la rémunération" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="postuler">Comment postuler :</label>
                        <textarea id="postuler" name="postuler" class="form-control" rows="5" placeholder="Indiquez comment postuler à l'offre" required></textarea>
                    </div>
                </div>



                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </div>
        </form>
    </div>


    <!-- Bootstrap Bundle avec Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>