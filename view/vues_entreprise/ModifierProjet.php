<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un projet tutoré</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="../../css/Entreprise_CSS/styleAjoutProjet.css">
</head>

<body>
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-6">Modifier un projet tutoré</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="tab-content">
                            <div id="description" class="tab-pane fade show active pt-3">
                                <form role="form"  action="ModifierProjetBD.php" method="post" enctype="multipart/form-data">
                                <?php
            echo "<div class='input-group mb-3'>\n";
            echo "<select name='id' id='id' class='form-select'>\n";
            echo "<option selected disabled>Vos projet tutoré</option>\n";

            try {
                $host = "localhost";
                $dbname = "id20742082_geii";
                $user = "root";
                $pass = "";

                $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("SELECT id_projet_tut, titre_projet_tut FROM projet_tut WHERE id_entreprise = :id_entreprise");
                
                $stmt->bindParam(':id_entreprise', $_SESSION['id_entreprise']);
                $stmt->execute();
               
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $selected = '';

                    // Vérification si l'identifiant de l'offre correspond à celui passé en paramètre
                    if (isset($_GET['id'])  == $row['id_projet_tut']) {
                        $selected = 'selected';
                    }
                    echo "<option value='" . $row['id_projet_tut'] . "' $selected>" . $row['titre_projet_tut'] . "</option>\n";
                    
                }

                $conn = null;
            } catch (PDOException $e) {
                echo "Erreur de connexion à la base de données : " . $e->getMessage();
            }

            echo "</select>\n";
            echo "</div>\n";
            ?>
                                    <div class="form-group">
                                        <label for="titre_projet_tut">
                                            <h6>Titre du projet</h6>
                                        </label>
                                        <input type="text" id="titre_projet_tut" name="titre_projet_tut" placeholder="Saisir le titre du projet" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="sujet_projet_tut">
                                            <h6>Description projet</h6>
                                        </label>
                                        <div class="input-group">
                                            <textarea id="sujet_projet_tut" name="sujet_projet_tut" placeholder="Décrire le projet" class="form-control" ></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="datedebut_projet_tut">
                                            <h6>Date de début du projet</h6>
                                        </label>
                                        <input type="date" id="datedebut_projet_tut" name="datedebut_projet_tut" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="datefin_projet_tut">
                                            <h6>Date de fin du projet</h6>
                                        </label>
                                        <input type="date" id="datefin_projet_tut" name="datefin_projet_tut" class="form-control" >
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="image_projet_tut">
                                            <h6>Image</h6>
                                        </label>
                                        <input type="file" id="image_projet_tut" name="image_projet_tut" accept="image/*" class="form-control"  >
                                    </div> -->
                                    <div class="form-group">
                                        <label for="pdf_projet_tut">
                                            <h6>Fichier PDF (Fichier descriptif)</h6>
                                        </label>
                                        <input type="file" id="pdf_projet_tut" name="pdf_projet_tut" accept="application/pdf" class="form-control"  >
                                    </div>
                                    <div class="card-footer"> <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm">Modifier</button> </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>