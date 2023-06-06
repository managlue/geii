<?php session_start(); ?>
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

		<!-- login or signup form -->
		<div class="slider"></div>
		<div class="btn">
			<button class="login">Connexion</button>
			<button class="signup">Créer un compte</button>
		</div>

		<!-- login form -->
		<div class="form-section">
			<form method="post" action="Connexion.php">
				<!-- login form -->
				<div class="login-box">
					<input type="email" class="email ele" id="email" name="email" placeholder="Saisissez votre adresse mail" required="required">
					<input type="password" class="password ele" id="pwd" name="pwd" placeholder="Saisissez votre mot de passe" required="required">
					<button class="clkbtn">Connexion</button>
					<hr />
					<div class="text-center">
						<label><a href="MotDePasseOublie.php">Mot de passe oublié?</a></label>
					</div>

				</div>
		
		</form>


		<!-- signup form -->
		<div class="signup-box">
			<form method="post" action="CreerUtilisateur.php">
				<input type="text" class="name ele" id="NomEntreprise" name="NomEntreprise" placeholder="Saisir le nom de votre entreprise" required="required">
				<input type="email" class="email ele" id="email_inscription" name="email_inscription" placeholder="Saisir votre adresse mail" required="required">
				<input type="phone" class="phone ele" id="phone" name="phone" placeholder="Saisir votre numéro de téléphone" required="required">
				<input type="password" class="password ele" id="pwd_inscription" name="pwd_inscription" placeholder="Créer votre mot de passe" required="required">
				<input type="password" class="password ele" id ="confirm_pwd" name="confirm_pwd" placeholder="Confirmez le mot de passe" required="required">


				<button class="clkbtn">Inscription</button>
			</form>
		</div>
	</div>
	</div>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
	<script src="scriptconnexion.js"></script>
	<script type="text/javascript"> 
        var passwordInput = document.getElementById("pwd_inscription");
        passwordInput.addEventListener("input", validatePassword);
    </script> 
</body>

</html>