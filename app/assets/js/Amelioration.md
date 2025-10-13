## Code d'origine

// variable boolean
let firstname = false;
let lastname = false;
let username = false;
let email = false;
let rgpd = false;
let password = false;

// attendre que le DOM soit chargé
document.addEventListener("DOMContentLoaded", () => {

    // on charge les éléments du formulaire
    document.querySelector('#registration_form_firstname').addEventListener('input', checkFirstname);
    document.querySelector('#registration_form_lastname').addEventListener('input', checkLastname);
    document.querySelector('#registration_form_username').addEventListener('input', checkUsername);
    document.querySelector('#registration_form_email').addEventListener('input', checkEmail);
    document.querySelector('#registration_form_agreeTerms').addEventListener('input', checkRgpd);
    document.querySelector('#registration_form_plainPassword').addEventListener('input', checkPassword);

    function checkFirstname() {
        firstname = this.value.length > 2;
        checkAll();
    }

    function checkLastname() {
        lastname = this.value.length > 2;
        checkAll();
    }

    function checkUsername() {
        username = this.value.length > 2;
        checkAll();
    }

    function checkEmail() {
        let regex = new RegExp("\\S+@\\S+\\.\\S+");
        email = regex.test(this.value);
        checkAll();
    }

    function checkRgpd() {
        rgpd = this.checked;
        checkAll();
    }

    function checkAll() {
        const btn = document.querySelector("#submit-button");
        btn.setAttribute("disabled", "disabled");
        if (firstname && lastname && username && email && rgpd && password) {
            btn.removeAttribute("disabled");
        }
    }

    const PasswordStrength = {
        STRENGTH_VERY_WEAK: 'Très faible',
        STRENGTH_WEAK: 'Faible',
        STRENGTH_MEDIUM: 'Moyen',
        STRENGTH_STRONG: 'Fort',
        STRENGTH_VERY_STRONG: 'Très fort'
    };

    function checkPassword() {
        let mdp = this.value;
        let entropyElement = document.querySelector('#entropy');
        if (!entropyElement) return;

        let entropy = evaluatePasswordStrength(mdp);

        entropyElement.classList.remove("text-red", "text-orange", "text-green");

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
            default:
                entropyElement.classList.add("text-red");
                password = false;
        }

        entropyElement.textContent = entropy;
        checkAll();
    }

    function evaluatePasswordStrength(password) {
        let length = password.length;
        if (!length) {
            return PasswordStrength.STRENGTH_VERY_WEAK;
        }

        let passedChars = {};

        for (let index = 0; index < length; index++) {
            let charCode = password.charCodeAt(index);
            passedChars[charCode] = (passedChars[charCode] || 0) + 1;
        }

        let chars = Object.keys(passedChars).length;

        let control = 0, digit = 0, upper = 0, lower = 0, symbol = 0, other = 0;

        for (let [chr, count] of Object.entries(passedChars)) {
            chr = Number(chr);
            if (chr < 32 || chr === 127) {
                control = 33;
            } else if (chr >= 48 && chr <= 57) {
                digit = 10;
            } else if (chr >= 65 && chr <= 90) {
                upper = 26;
            } else if (chr >= 97 && chr <= 122) {
                lower = 26;
            } else if (chr >= 128) {
                other = 128;
            } else {
                symbol = 33;
            }
        }

        let pool = control + digit + upper + lower + symbol + other;

        let entropy = chars * Math.log2(pool) + (length - chars) * Math.log2(chars);

        if (entropy >= 120) {
            return PasswordStrength.STRENGTH_VERY_STRONG;
        } else if (entropy >= 100) {
            return PasswordStrength.STRENGTH_STRONG;
        } else if (entropy >= 80) {
            return PasswordStrength.STRENGTH_MEDIUM;
        } else if (entropy >= 60) {
            return PasswordStrength.STRENGTH_WEAK;
        } else {
            return PasswordStrength.STRENGTH_VERY_WEAK;
        }
    }
});

---

## 1. Différences entre mon code et la version corrigée

Différences entre ton code et la version corrigée
Partie          Mon code            Version corrigée                                Pourquoi c’est mieux dans la version corrigée
Structure       Tout le code est dans un seul bloc DOMContentLoaded.                Les fonctions sont déclarées en dehors de l’écouteur, et seulement leur initialisation est faite à l’intérieur.         → Plus modulaire : les fonctions peuvent être testées ou réutilisées ailleurs.

Vérification DOM    tous les éléments existent (document.querySelector('#registration_form_firstname')).    La version corrigée vérifie leur présence avant d’ajouter les écouteurs (avec if (!element) return).        → Évite les erreurs JS bloquantes si un champ change de nom dans le formulaire.

Validation globale      btn.setAttribute("disabled", "disabled"); à chaque appel de checkAll().     On ne modifie le bouton que si nécessaire (plus léger).     → Moins de reflows/recalculs DOM, plus fluide.

Régex email	new RegExp("\\S+@\\S+\\.\\S+")      /^[^\s@]+@[^\s@]+\.[^\s@]+$/ (simplifiée et plus lisible)   → Même logique, mais syntaxe plus claire et plus rapide.

Calcul de l’entropie    calcules selon un schéma ASCII détaillé (très précis).      Je calcule avec la variété de caractères (maj, min, chiffre, symbole).      → Plus simple, moins mathématique, mais plus adapté au web (UX).

Résultat “entropy”      text-red, text-orange, text-green + texte.      Idem, mais avec classes cohérentes et structure prête à étendre (progress bar).     → Même rendu visuel, mieux organisé.

Lisibilité générale     Très dense, beaucoup de code logique dans une seule fonction.   Plus clair : chaque section a une responsabilité.       → Meilleure maintenabilité.

💡 En résumé

code d'origine + complet et précis, mais un peu “lourdingue” pour un navigateur (calcul ASCII + redondances).

La version corrigée allège la logique, sécurise le DOM et prépare la partie graphique (progress bar).

Résultat : un code plus performant, plus maintenable et plus lisible.