<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="connexion_admin.css">
</head>

<body>
  <div class="card">
    <div class="card-header">
      <h3>Admin</h3>
    </div>
    <div class="card-body">
      <form method="POST" action="adminco.php">
        <div class="mb-3">
          <label for="identifiant" class="form-label">Identifiant :</label>
          <input type="text" class="form-control" id="identifiant" name="identifiant" placeholder="Entrez votre identifiant" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Mot de passe :</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
        </div>
        <button class="btn btn-primary">Connexion</button>
      </form>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>


