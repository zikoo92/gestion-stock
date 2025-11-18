# Plateforme de Gestion de Stock

## Description du projet

Cette application est une mini‑plateforme de gestion de stock développée avec **Laravel 12** et **PostgreSQL**. Elle permet l’authentification via **OAuth2**, ainsi que la gestion complète des produits : ajout, modification, suppression, recherche, tri, pagination et ajustement des quantités.

L’interface est entièrement **responsive**, réalisée avec **Tailwind CSS**.

---

##  Fonctionnalités

## Authentification (via OAuth2)

* Inscription
* Connexion
* Mot de passe oublié

## Gestion des produits

* Ajouter un produit
* Modifier un produit
* Supprimer un produit
* Affichage détaillé d’un produit
* Champs pris en charge :

  * Nom
  * SKU (unique)
  * Prix d’achat
  * Prix de vente
  * Quantité restante
  * Image
* Ajustement de la quantité (augmentation / diminution)

## Liste des produits

* Recherche par *Nom* ou *SKU*
* Tri dynamique
* Pagination
* Interface responsive avec Tailwind CSS

---

## Installation et exécution (local)

## Cloner le projet

```
git clone https://github.com/zikoo92/gestion-stock.git
cd gestion-stock
```

## Installer les dépendances

```
composer install
npm install
```



Modifier ensuite les informations de connexion PostgreSQL :

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=gestion_stock
DB_USERNAME=postgres
DB_PASSWORD=intel922

## Générer la clé de l’application

```
php artisan key:generate
```

## Exécuter les migrations

```
php artisan migrate
```

## Lancer le serveur

```
php artisan serve
```

## Compiler les assets (Tailwind)

```
npm run dev
```

L’application sera accessible sur :

```
http://127.0.0.1:8000
```

Projet réalisé dans le cadre d’un test technique pour une évaluation de compétences Laravel.

---

Si vous avez des questions, n’hésitez pas à me contacter.
