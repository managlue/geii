<!-- formulaire de connexion -->
<form action="login.php" method="POST">
    <label for="login">Login:</label>
    <input type="text" id="login" name="login" required><br><br>
    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Se connecter">
</form>

<?php

include 'connexionBd.php';

// Récupérer les données du formulaire
if (!isset($_POST['login']) || !isset($_POST['password'])) exit;
$login = $_POST['login'];
$password = $_POST['password'];

foreach (['etudiant', 'enseignant'] as $lookFor) {
    $results = login($lookFor, $login, $pdo);

    if (!empty($results)) {
        $passwd =  $results[0]["pswd_$lookFor"];

        // if (password_verify($password, $passwd)) {
        if ($password == $passwd) {
            if (isset($results[0]["id_$lookFor"])) {
                session_start();
                $_SESSION['idConnected'] = $results[0]["id_$lookFor"];
                $_SESSION['nom'] = $results[0]["nom_$lookFor"];
                $_SESSION['prenom'] = $results[0]["prenom_$lookFor"];
            }
            header("location: ../view/vues_$lookFor/$lookFor" . '.php');
            exit;
        } else $pb = 'Mot de passe';
    } else $pb = 'Identifiant';
}

echo "$pb incorrect.";

function login($who, $login, $pdo)
{
    $sql = "SELECT *
            FROM $who
            WHERE login_$who = :login";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':login', $login);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}

?>
