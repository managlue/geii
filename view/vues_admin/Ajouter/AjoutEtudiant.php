<!DOCTYPE html>
<html>
  
<?php include '../../../modele/connexionBd.php'; ?>

<head>
  <title>Création d'étudiants</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css">
</head>

<body>
  <h2>Ajouter des étudiants</h2>

  <p>Combien voulez-vous ajouter d'étudiants</p>

<?php
  $nb = 5;
  if (isset($_POST['nb']) && $_POST['nb'] > 0) $nb = $_POST['nb'];
?>

  <form method="post" action="">
    <input type="number" class="ele" id="nb" name="nb" placeholder="Combien d'étudiants voulez vous ajouter ?">
    <button>Valider</button>
  </form>

  <p>Entrez des étudiants en saisissant leurs paramètres</p>

  <div class="container">
    <div class="form-section">
      <form method="POST" action="">

<?php
  for ($cpt = 0; $cpt < $nb; $cpt++) {
?>

        <div class="login-box">
          <input type="text"     id="nom"      name="nom<?php echo $cpt; ?>"      placeholder="Nom">
          <input type="text"     id="prenom"   name="prenom<?php echo $cpt; ?>"   placeholder="Prénom">
          <input type="text"     id="login"    name="login<?php echo $cpt; ?>"    placeholder="Identifiant">
          <input type="password" id="password" name="password<?php echo $cpt; ?>" placeholder="Mot de passe">
          <input type="number"   id="class"    name="class<?php echo $cpt; ?>"    placeholder="Classe">
        </div>

        <br>
<?php
  }
?>

        <button name="ajouter">Ajouter tous</button>

      </form>
    </div>
  </div>
</body>

</html>

<?php
  if (isset($_POST['ajouter'])) {
    $sql = "INSERT INTO etudiant (nom_etudiant, prenom_etudiant, login_etudiant, pswd_etudiant, id_classe) VALUES ";
    $requestIsValide = false;

    for ($cpt = 0; $cpt < $nb; $cpt++) {
      if (!empty($_POST["nom$cpt"]) && !empty($_POST["prenom$cpt"]) && !empty($_POST["login$cpt"]) && !empty($_POST["password$cpt"]) && !empty($_POST["class$cpt"])) {
        $sql .= "('" . $_POST["nom$cpt"] . "','" . $_POST["prenom$cpt"] . "','" . $_POST["login$cpt"] . "','" . password_hash($_POST["password$cpt"], PASSWORD_DEFAULT) . "'," . intval($_POST["class$cpt"]) . ")";
        $requestIsValide = true;
      }
    }

    $sql = str_replace(')(', '), (', $sql);
    $sql .= ';';

    if ($requestIsValide) {
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
    }
  }
?>
