<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposer un projet tutoré</title>
    <link href="../../bootstrap-5.3/css/bootstrap.min.css" rel="stylesheet">   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="../../css/Entreprise_CSS/styleAjoutProjet.css">
</head>

<body>
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-6">Publier un projet tutoré</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="tab-content">
                            <div id="description" class="tab-pane fade show active pt-3">
                                <form role="form"  action="AjouterProjetBD.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="titre_projet_tut">
                                            <h6>Titre du projet</h6>
                                        </label>
                                        <input type="text" id="titre_projet_tut" name="titre_projet_tut" placeholder="Saisir le titre du projet" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="sujet_projet_tut">
                                            <h6>Description projet</h6>
                                        </label>
                                        <div class="input-group">
                                            <textarea id="sujet_projet_tut" name="sujet_projet_tut" placeholder="Décrire le projet" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="datedebut_projet_tut">
                                            <h6>Date de début du projet</h6>
                                        </label>
                                        <input type="date" id="datedebut_projet_tut" name="datedebut_projet_tut" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="datefin_projet_tut">
                                            <h6>Date de fin du projet</h6>
                                        </label>
                                        <input type="date" id="datefin_projet_tut" name="datefin_projet_tut" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="image_projet_tut">
                                            <h6>Image</h6>
                                        </label>
                                        <input type="file" id="image_projet_tut" name="image_projet_tut" accept="image/*" class="form-control"  required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pdf_projet_tut">
                                            <h6>Fichier PDF (Fichier descriptif)</h6>
                                        </label>
                                        <input type="file" id="pdf_projet_tut" name="pdf_projet_tut" accept="application/pdf" class="form-control"  required>
                                    </div>
                                    <div class="card-footer"> <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm">Confirmer</button> </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../bootstrap-5.3/js/bootstrap.min.js"></script>
</body>

</html>