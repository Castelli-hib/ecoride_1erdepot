# Workflow Git pour Ecoride / Symfony

## 1. Branches principales

- **main**  
  Contient le code stable et déployable.  
  On ne touche à `main` que pour des versions testées et validées.

- **devop (ou develop)**  
  Branche de développement.  
  Tous les changements passent par `devop` avant d’être fusionnés dans `main`.  
  Sert de base pour créer des branches fonctionnalités ou correctifs.

---

## 2. Branches secondaires (features / bugfix)

- ** Nommer les branches par type et fonctionnalité, par exemple :  

feature/registration-form
feature/search-trajet
bugfix/fix-login

## Elles partent toujours de `devop`  

git checkout devop
git checkout -b feature/registration-form

<!-- Une fois terminées, elles sont fusionnées dans devop : -->
git checkout devop
git merge feature/registration-form
git push origin devop

## 3. Fusion dans main

- ** Quand devop est stable (après tests locaux ou unitaires) :
git checkout main
git merge devop
git push origin main
git push origin devop

## Fusionner devop dans main quand stable

git checkout main
git pull origin main
git merge devop
git push origin main
💡 Conseil : toujours ignorer les fichiers sensibles et volumineux (.env, vendor/, node_modules/, var/, public/build/) pour garder le dépôt propre.

## Ajouter les fichiers à l’index (staging area)

git add README.md
git add .

## Committer les changements avec un message clair

git commit -m "Ajout du README avec les commandes Docker essentielles"

## Pousser la branche sur le dépôt distant (feature/readme)

git push -u origin feature/readme

## (Optionnel) Créer une Pull Request sur GitHub pour fusionner feature/readme dans devop une fois que tout est prêt et relu

## Ajouter le dossier à l’index Git

git add Documents_README/

## Committer les changements

git commit -m "Ajout du dossier Documents_README avec tous les README"

## Pousser la branche sur le dépôt distant

git push -u origin feature/README_GIT.md
ajouter d’autres fichiers README plus tard, faire :
git add Documents_README/README_AUTRE.md
git commit -m "Ajout du README_AUTRE"
git push
