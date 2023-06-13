<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Réinitialisation de mot de passe</title>
	<link rel="stylesheet" href="../../css/Entreprise_CSS/style.css">  
</head>

<body>

	<div class="container">
		<div class="form-section">
			<form method="post" action="MotDePasseOublieeBD.php"> 
				<!-- login form -->
				<div class="login-box">
					<input type="email" class="email ele" id="toEmail" name="toEmail" placeholder="Saisissez votre adresse mail" required>
					<button type="submit" name="sendMailBtn" href ="MotDePasseOublieeBD.php" class="clkbtn">Envoyer</button>

				</div>
			</form> 
		</div>
	</div>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

</body>

</html>
