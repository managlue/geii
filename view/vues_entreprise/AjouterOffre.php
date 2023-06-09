<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier une offre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="../../css/Entreprise_CSS/styleAjouterOffre.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <h2 id="heading">Publier une offre</h2>
                    <p>Remplissez tous les champs du formulaire pour passer à l'étape suivante</p>

                    <form id="msform" action="AjouterOffreBD.php" method="post" enctype="multipart/form-data">
                        <!-- progressbar -->
                        <ul id="progressbar">
                        <li class="active" id="company"><strong>Entreprise</strong></li>
                            <li id="offre"><strong>Ajouter Offre</strong></li>
                            <li id="information"><strong>Information offre</strong></li>
                            <li id="logo"><strong>Logo</strong></li>
                        </ul>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <br>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Informations de l'entreprise :</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Étape 1 - 4</h2>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description_entr ">Description de l'entreprise :</label>
                                    <textarea id="description_entr " name="description_entr" class="form-control" rows="5"
                                        placeholder="Entrez la description de l'entreprise" required></textarea>
                                </div>
                            </div>
                            <input type="button" name="next" class="next action-button" value="Suivant" />
                        </fieldset>
                        <!-- fieldsets -->
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Informations du poste :</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Étape 2 - 4</h2>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="titre">Titre du poste :</label>
                                    <input class="form-control" id="titre" name="titre" type="text"
                                        placeholder="Entrez le titre du poste" required>
                                </div>
                                <div class="form-group">
                                    <label for="lieu">Lieu :</label>
                                    <input class="form-control" id="lieu" name="lieu" type="text"
                                        placeholder="Entrez le lieu" required>
                                </div>
                                <div class="form-group">
                                    <label for="contrat">Type de contrat :</label>
                                    <select class="form-control" id="contrat" name="contrat" required>
                                        <option value="">-- Sélectionnez un type de contrat --</option>
                                        <option value="Alternance">Alternance</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="date_limite">Date limite de candidature :</label>
                                    <input class="form-control" id="date_limite" name="date_limite" type="date" required>
                                </div>
                            </div>
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Précédent" />
                            <input type="button" name="next" class="next action-button" value="Suivant" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Information du poste :</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Étape 3 - 4</h2>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description du poste :</label>
                                    <textarea id="description" name="description" class="form-control" rows="5"
                                        placeholder="Entrez la description du poste" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="competences">Compétences requises :</label>
                                    <textarea id="competences" name="competences" class="form-control" rows="5"
                                        placeholder="Entrez les compétences requises" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="remuneration">Rémunération :</label>
                                    <input class="form-control" id="remuneration" name="remuneration" type="text"
                                        placeholder="Entrez la rémunération" required>
                                </div>
                                <div class="form-group">
                                    <label for="postuler">Comment postuler :</label>
                                    <textarea id="postuler" name="postuler" class="form-control" rows="5"
                                        placeholder="Indiquez comment postuler à l'offre" required></textarea>
                                </div>
                            </div>
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Précédent" />
                            <input type="button" name="next" class="next action-button" value="Suivant" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Image :</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Étape 4 - 4</h2>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image">Logo :</label>
                                    <input class="form-control-file" id="image" name="image" type="file"
                                        accept=".jpg, .jpeg, .png">
                                </div>
                            </div>
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Précédent" />
                            <input type="submit" name="submit" class="submit action-button" value="Soumettre" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- <script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../../script/scriptAO.js"></script>
</body>

</html>