// --- Variables de contrôle des champs
let firstname = false;
let lastname = false;
let username = false;
let email = false;
let rgpd = false;
let password = false;

// --- Récupération des éléments du formulaire
document.addEventListener('DOMContentLoaded', () => {
    const firstnameInput = document.querySelector('#registration_form_firstname');
    const lastnameInput = document.querySelector('#registration_form_lastname');
    const usernameInput = document.querySelector('#registration_form_username');
    const emailInput = document.querySelector('#registration_form_email');
    const rgpdCheckbox = document.querySelector('#registration_form_agreeTerms');
    const passwordInput = document.querySelector('#registration_form_plainPassword');

    if (!firstnameInput || !lastnameInput || !usernameInput || !emailInput || !rgpdCheckbox || !passwordInput) {
        console.warn(' Certains champs du formulaire sont introuvables.');
        return;
    }

    firstnameInput.addEventListener('input', checkFirstname);
    lastnameInput.addEventListener('input', checkLastname);
    usernameInput.addEventListener('input', checkUsername);
    emailInput.addEventListener('input', checkEmail);
    rgpdCheckbox.addEventListener('change', checkRgpd);
    passwordInput.addEventListener('input', checkPassword);
});

// --- Fonctions de validation
function checkFirstname() {
    firstname = this.value.trim().length >= 2;
    checkAll();
}

function checkLastname() {
    lastname = this.value.trim().length >= 2;
    checkAll();
}

function checkUsername() {
    username = this.value.trim().length >= 3;
    checkAll();
}

function checkEmail() {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    email = regex.test(this.value.trim());
    checkAll();
}

function checkRgpd() {
    rgpd = this.checked;
    checkAll();
}

// --- Vérifie si tous les champs sont bons
function checkAll() {
    const button = document.querySelector("#submit-button");
    if (!button) return;

    if (firstname && lastname && username && email && rgpd && password) {
        button.removeAttribute("disabled");
    } else {
        button.setAttribute("disabled", "disabled");
    }
}

// --- Dictionnaire de force du mot de passe
const PasswordStrength = {
    STRENGTH_VERY_WEAK: 'Très faible',
    STRENGTH_WEAK: 'Faible',
    STRENGTH_MEDIUM: 'Moyen',
    STRENGTH_STRONG: 'Fort',
    STRENGTH_VERY_STRONG: 'Très fort'
};

// --- Vérification du mot de passe
function checkPassword() {
    const mdp = this.value;
    const entropyElement = document.querySelector('#entropy');
    const bar = document.querySelector('#password-bar');
    if (!entropyElement || !bar) return;

    const entropy = evaluatePasswordStrength(mdp);
    entropyElement.classList.remove("text-red", "text-orange", "text-green");

    // Valeurs par défaut
    let width = 20;
    let color = "red";

    switch (entropy) {
        case PasswordStrength.STRENGTH_VERY_WEAK:
        case PasswordStrength.STRENGTH_WEAK:
            entropyElement.classList.add("text-red");
            password = false;
            break;
        case PasswordStrength.STRENGTH_MEDIUM:
            entropyElement.classList.add("text-orange");
            password = false;
            break;
        case PasswordStrength.STRENGTH_STRONG:
        case PasswordStrength.STRENGTH_VERY_STRONG:
            entropyElement.classList.add("text-green");
            password = true;
            break;
    }

    // Actualise la barre
    bar.style.width = width + "%";
    bar.style.backgroundColor = color;

    entropyElement.textContent = entropy;
    checkAll();
}

// --- Calcul de l'entropie du mot de passe
function evaluatePasswordStrength(password) {
    const length = password.length;
    if (length === 0) return PasswordStrength.STRENGTH_VERY_WEAK;

    let hasLower = /[a-z]/.test(password);
    let hasUpper = /[A-Z]/.test(password);
    let hasDigit = /\d/.test(password);
    let hasSymbol = /[^a-zA-Z\d]/.test(password);

    let variety = [hasLower, hasUpper, hasDigit, hasSymbol].filter(Boolean).length;
    let entropy = length * Math.log2(10 * variety);

    if (entropy >= 120) return PasswordStrength.STRENGTH_VERY_STRONG;
    if (entropy >= 100) return PasswordStrength.STRENGTH_STRONG;
    if (entropy >= 80) return PasswordStrength.STRENGTH_MEDIUM;
    if (entropy >= 60) return PasswordStrength.STRENGTH_WEAK;
    return PasswordStrength.STRENGTH_VERY_WEAK;
}
