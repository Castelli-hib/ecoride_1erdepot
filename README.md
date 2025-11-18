# Ecoride_1erDepot

C'est pas terrible mais c'est un début

## ECORIDE — Synthèse Technique du Projet

## 1. Présentation du projet

**Nom du projet :** Ecoride  
**Objectif :** Créer une plateforme de covoiturage écologique favorisant les trajets locaux et régionaux.  
**Type de projet :** Application web responsive, mobile-first  
**Technologies principales :** Symfony (back-end), Bootstrap / SCSS (front-end), Docker (environnement)

### Objectifs fonctionnels

- Mettre en relation des **passagers** et **conducteurs**
- Permettre la **création et la recherche de trajets**
- Gérer un **espace utilisateur** (profil, trajets, réservations...)
- Faciliter la **communication** entre usagers via un système de contact
- configurer un **espace administrateur** pour la gestion des employés et la gestion de la plateforme
- ouvrir un **espace employés** pour la gestion des utilisateurs et la modération des avis et des litiges

---

## 2. Environnement de développement

### Architecture logicielle

- **Système hôte :** Windows 11 / WSL2 (Ubuntu/Debian)
- **Conteneurisation :** Docker & Docker Compose
- **Serveur web :** Apache 2 (conteneur PHP)
- **Base de données :** MySQL
- **Interface BDD :** phpMyAdmin
- **Outils auxiliaires :** Mailhog (test des emails)

### Structure Docker

**Système hôte :** Windows 11 / WSL2 (Ubuntu/Debian)

- **Conteneurisation :** Docker & Docker Compose
- **Serveur web :** Apache 2 (conteneur PHP)
- **Base de données :** MySQL
- **Interface BDD :** phpMyAdmin
- **Outils auxiliaires :** Mailhog (test des emails)

### Arborescence du projet

ecoride/
│
├── app/ # Projet Symfony
│ ├── dockerfile.dev # Dockerfile de développement
│ ├── dockerfile-prod # Dockerfile de production
│ ├── apache/
│ │ ├── default.conf
│ │ └── default-ssl.conf
│ └── ...
│
├── compose.yaml
└── mysql/ # Volume persistant MySQL

## Projet Ecoride repose sur une architecture moderne et modulaire

- **Environnement Dockerisé** prêt pour le développement et la production

- **Base Symfony** claire, scalable et extensible

## Front responsive conforme à la charte graphique

- **Découplage MVC**  entre logique, présentation et données

## Prochaines étapes

- **Ajout d’une API interne JSON** pour la recherche de trajets

- **Système de messagerie interne** entre utilisateurs

- **Tests unitaires** et fonctionnels avec PHPUnit

## Sécurité et authentification des utilisateurs

- **Pour la gestion des connexions et inscriptions, j’ai mis en place un système basé sur **JSON Web Token (JWT)** via le **LexikJWTAuthenticationBundle** de Symfony.

### 1. Principe

- **Lorsqu’un utilisateur se connecte, le serveur génère un **jeton JWT signé** avec une clé secrète stockée dans le fichier `.env`.  
Ce jeton contient des informations d’identification (comme l’email et le rôle), et il est envoyé au client.

- **Lors de chaque requête vers une ressource protégée**, le client envoie ce jeton dans l’en-tête HTTP :

```http

Authorization: Bearer <token>
https://www.jwt.io/

