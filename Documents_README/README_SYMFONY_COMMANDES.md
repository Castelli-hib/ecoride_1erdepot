
# 🧰 Commandes Bash essentielles pour Symfony

Ce document récapitule les commandes Bash les plus utiles pour développer avec Symfony (version 6 ou 7).

---

## 🧱 1. Création du projet Symfony

### Projet complet (avec Twig, Doctrine, etc.)
```bash
symfony new nom_du_projet --webapp
```

### Projet minimal
```bash
symfony new nom_du_projet
```

---

## 🚀 2. Lancer le serveur local Symfony
```bash
symfony serve
```

### En arrière-plan :
```bash
symfony serve -d
```

### Arrêter le serveur :
```bash
symfony server:stop
```

---

## 📦 3. Installer des composants

### Exemple avec Doctrine + annotations + Twig :
```bash
composer require symfony/orm-pack
composer require annotations
composer require twig
```

---

## 🧬 4. Créer une entité
```bash
php bin/console make:entity
```

---

## 🗃️ 5. Gérer la base de données

### Créer la base :
```bash
php bin/console doctrine:database:create
```

### Générer une migration :
```bash
php bin/console make:migration
```

### Appliquer une migration :
```bash
php bin/console doctrine:migrations:migrate
```

---

## ✏️ 6. Créer un contrôleur
```bash
php bin/console make:controller NomController
```

---

## 📋 7. Créer un formulaire
```bash
php bin/console make:form
```

---

## 🔐 8. Mettre en place une authentification

```bash
composer require symfony/security-bundle
php bin/console make:user
php bin/console make:auth
```

---

## 🧪 9. Lancer les tests PHPUnit
```bash
php bin/phpunit
```

---

## 🧼 10. Nettoyer le cache
```bash
php bin/console cache:clear
```

---

## 🔍 11. Debug et vérification

### Voir les routes :
```bash
php bin/console debug:router
```

### Voir les services :
```bash
php bin/console debug:container
```

### Voir la configuration :
```bash
php bin/console debug:config
```

---

## 📝 Notes

- Toutes les commandes doivent être lancées à la racine du projet.
- Composer doit être installé : [getcomposer.org](https://getcomposer.org/)
- L'outil `symfony` est requis : [symfony.com/download](https://symfony.com/download)

---
