<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Espace Entreprise</title>
    <link rel="stylesheet" href="style.css">

    <script type="text/javascript">
        function validatePassword() {
            var password = document.getElementById("pwd").value;
            var strengthMessage = document.getElementById("msg");

            var hasUppercase = /[A-Z]/.test(password);
            var hasLowercase = /[a-z]/.test(password);
            var hasDigit = /[0-9]/.test(password);
            var hasSpecialChar = /[^a-zA-Z0-9]/.test(password);
            var isLongEnough = password.length >= 10;

            if (hasUppercase && hasLowercase && hasDigit && hasSpecialChar && isLongEnough) {
                strengthMessage.innerHTML = "<p style='color:green'>Mot de passe fort.</p>";
            } else {
                strengthMessage.innerHTML = "<p style='color:red'>Mot de passe faible.</p>";
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <!-- signup form -->
        <div class="signup-box">
            <form method="post" action="AjoutEntrepriseBD.php">
                <input type="text" class="name ele" id="NomEntreprise" name="NomEntreprise" placeholder="Saisir le nom de votre entreprise">
                <input type="email" class="email ele" id="email_inscription" name="email_inscription" placeholder="Saisir votre adresse mail">
                <input type="phone" class="phone ele" id="phone" name="phone" placeholder="Saisir votre numéro de téléphone" >
                <input type="password" class="password ele" id="pwd_inscription" name="pwd_inscription" placeholder="Créer votre mot de passe" onkeyup="validatePassword()">
                <input type="password" class="password ele" id="confirm_pwd" name="confirm_pwd" placeholder="Confirmez le mot de passe" >
                <div id="msg"></div>
                <button class="clkbtn">Ajouter</button>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
	<script src="../../script/scriptconnexion.js"></script>
	<script type="text/javascript"> 
        var passwordInput = document.getElementById("pwd_inscription");
        passwordInput.addEventListener("input", validatePassword);
    </script> 
</body>

</html>
