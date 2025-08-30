
# 📘 Filtres Twig – Guide complet

Twig est le moteur de templates utilisé par Symfony. Les **filtres** permettent de **modifier ou formater une variable** directement dans le template.

---

## 🔹 Syntaxe de base

```twig
{{ variable|filtre }}
```

Certains filtres acceptent des **arguments** :

```twig
{{ variable|filtre(argument1, argument2) }}
```

---

## 🔧 Filtres courants

| **Filtre**         | **Description**                                               | **Exemple** |
|--------------------|---------------------------------------------------------------|-------------|
| `capitalize`        | Met en majuscule la première lettre                          | `{{ 'bonjour'|capitalize }}` → `Bonjour` |
| `upper`             | Met tout en majuscule                                       | `{{ 'bonjour'|upper }}` → `BONJOUR` |
| `lower`             | Met tout en minuscule                                       | `{{ 'BONJOUR'|lower }}` → `bonjour` |
| `title`             | Majuscule sur chaque mot                                    | `{{ 'salut le monde'|title }}` → `Salut Le Monde` |
| `length`            | Donne la longueur (caractères ou éléments d’un tableau)     | `{{ 'abcde'|length }}` → `5` |
| `date`              | Formate une date                                             | `{{ myDate|date('d/m/Y') }}` |
| `number_format`     | Formate un nombre avec séparateur                           | `{{ 12345.678|number_format(2, ',', ' ') }}` → `12 345,68` |
| `join`              | Concatène les éléments d’un tableau                         | `{{ ['a', 'b', 'c']|join(', ') }}` → `a, b, c` |
| `replace`           | Remplace une chaîne par une autre                           | `{{ 'Bonjour'|replace({'jour': 'soir'}) }}` → `Bonsoir` |
| `default`           | Valeur par défaut si vide ou nul                            | `{{ nom|default('Inconnu') }}` |
| `trim`              | Supprime les espaces autour                                 | `{{ '  Hello  '|trim }}` → `Hello` |
| `nl2br`             | Remplace les `\n` par des `<br>`                            | `{{ texte|nl2br }}` |
| `json_encode`       | Encode en JSON                                               | `{{ variable|json_encode }}` |
| `merge`             | Fusionne deux tableaux                                       | `{{ [1, 2]|merge([3, 4]) }}` → `[1, 2, 3, 4]` |
| `sort`              | Trie un tableau                                              | `{{ [3, 1, 2]|sort }}` → `[1, 2, 3]` |
| `reverse`           | Inverse un tableau ou une chaîne                            | `{{ 'abc'|reverse }}` → `cba` |
| `keys`              | Retourne les clés d’un tableau                              | `{{ {'a': 1, 'b': 2}|keys }}` → `['a', 'b']` |
| `escape`            | Protège les caractères HTML                                 | `{{ '<strong>'|escape }}` → `&lt;strong&gt;` |
| `e` (alias de escape) | Idem que `escape`                                         | `{{ texte|e }}` |
| `raw`               | Affiche du HTML sans échappement                            | `{{ texte|raw }}` *(⚠️ Attention à la sécurité)* |

---

## 📍 Filtres utiles avec les **dates**

```twig
{{ post.publishedAt|date('d/m/Y H:i') }}
{{ birthday|date('l, F jS') }} {# lundi, avril 22 #}
```

---

## ✅ Astuce : Combinaison de filtres

```twig
{{ user.name|upper|replace({'É': 'E'}) }}
```

---

## 🔐 Sécurité : raw vs escape

- `escape` ou `e` : protège contre l'injection HTML ou XSS.
- `raw` : désactive la protection. À **éviter sauf si sûr de la source**.
