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

    $results = login('etudiant', $login, $pdo);

    if (!empty($results)) {
        $lookFor = 'etudiant';
        $passwd =  $results[0]["pswd_$lookFor"];
    } else {
        $results = login('enseignant', $login, $pdo);
        if (!empty($results)) {
            $lookFor = 'enseignant';
            $passwd =  $results[0]['pswd_enseignant'];
        } else {
            echo 'Idendifiant incorrect.';
            exit;
        }
    }

    // if (password_verify($password, $passwd)) {
    if ($password == $passwd) {    
        if (isset($results[0]["id_$lookFor"])) {
            session_start();
            $_SESSION['idConnected'] = $results[0]["id_$lookFor"];
            $_SESSION['nom'] = $results[0]["nom_$lookFor"];
            $_SESSION['prenom'] = $results[0]["prenom_$lookFor"];
            var_dump($_SESSION);
        }
        header("location: ../view/$lookFor" . '.php');

    } else echo 'Mot de passe incorrect.';
    
    function login($who, $login, $pdo) {
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
