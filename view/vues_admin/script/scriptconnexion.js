let signup = document.querySelector(".signup");
let login = document.querySelector(".login");
let slider = document.querySelector(".slider");
let formSection = document.querySelector(".form-section");

signup.addEventListener("click", () => {
	slider.classList.add("moveslider");
	formSection.classList.add("form-section-move");
});

login.addEventListener("click", () => {
	slider.classList.remove("moveslider");
	formSection.classList.remove("form-section-move");
});

var passwordInput = document.querySelector('.signup-box input[name="pwd_inscription"]');
var confirmPasswordInput = document.querySelector('.signup-box input[name="confirm_pwd"]');

// Ajoutez un écouteur d'événement sur le bouton d'inscription
var signupButton = document.querySelector('.signup-box .clkbtn');
signupButton.addEventListener('click', function(event) {
    // Vérifiez si les mots de passe correspondent
    if (passwordInput.value !== confirmPasswordInput.value) {
        event.preventDefault(); // Empêche l'envoi du formulaire
        alert("Le mot de passe et la confirmation du mot de passe ne correspondent pas.");
    }
})
