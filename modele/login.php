<!-- formmulaire de connection -->
<form action="login.php" method="POST">
    <label for="login">Login:</label>
    <input type="text" id="login" name="login" required><br><br>
    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Se connecter">
</form>

<?php
    // Récupérer les données du formulaire
    $login = $_POST['login'];
    $password = $_POST['password'];

    $results = login('Etudiant', $login, $pdo);

    if (empty($results)) {
        $results = login('Enseignant', $login, $pdo);
    }

    if (empty($results)) {
        // popup d'erreur
        // on ne fait rien d'autre
    }

    if (password_verify($password, $results['pswd'])) {
        echo "Authentification réussie !";
        echo 'Bienvenue ' . $results['nom'] . ', ' . $results['nom'] . ' !';
    }
    

    function login($who, $login, $pdo) {
        $sql = "SELECT *
                FROM $who
                WHERE login = :login";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':login', $login);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
?>