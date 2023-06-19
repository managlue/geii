<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/geii/css/Entreprise_CSS/style.css">
</head>
    
<body>
    <div class="container">
        <div class="form-section">
            <form action="login.php" method="POST">
                <div class="login-box">
                    <input type="text" class="ele" id="login" name="login" placeholder="Insérez votre identifiant" required>
                    <input type="password" class="password ele" id="password" name="password" placeholder="Insérez votre mot de passe" required>
                    <button class="clkbtn">Connexion</button>
                </div>
            </form>
        </div>
    </div>
</body>

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
                $_SESSION['idClass'] = $results[0]["id_classe"];

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
