<!DOCTYPE html>
<html>
<head>
  <title>Création d'un enseignant</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css">
</head>
<body>
  <h2>Création d'un enseignant</h2>
  <form action="AjoutEnseignantBD.php" method="post">
    <div class="mb-3">
      <label for="nom" class="form-label">Nom de l'enseignant :</label>
      <input type="text" class="form-control" id="nom" name="nom" required>
    </div>

<div class="mb-3">
  <label for="prenom" class="form-label">Prénom de l'enseignant :</label>
  <input type="text" class="form-control" id="prenom" name="prenom" required>
</div>

<div class="mb-3">
  <label for="login" class="form-label">Login :</label>
  <input type="text" class="form-control" id="login" name="login" required>
</div>

<div class="mb-3">
  <label for="password" class="form-label">Mot de passe :</label>
  <input type="password" class="form-control" id="password" name="password" required>
</div>

<div class="mb-3">
  <label for="classes" class="form-label">Classes :</label>
  <select id="classes" name="classes[]" multiple required class="form-select">
    <option value="1">Classe 1</option>
    <option value="2">Classe 2</option>
    <option value="3">Classe 3</option>
    <!-- Ajoutez ici d'autres options pour les classes -->
  </select>
</div>

<div class="mb-3">
  <label for="matieres" class="form-label">Matières :</label>
  <select id="matieres" name="matieres[]" multiple required class="form-select">
    <option value="1">Énergie</option>
    <option value="2">Système d'information numérique</option>
    <option value="3">Informatique</option>
    <!-- Ajoutez ici d'autres options pour les matières -->
  </select>
</div>

<button type="submit" class="btn btn-primary">Créer l'enseignant</button>
  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</htm