# 🅿️ Parking ENSAJ — Back-end Laravel

Système de gestion du parking de l'École Nationale des Sciences Appliquées d'El Jadida (ENSAJ).

## 🛠️ Technologies utilisées
- **Laravel** (PHP) — API RESTful
- **MySQL** — Base de données
- **Laravel Sanctum** — Authentification par token
- **PHP 8.x**

## 📦 Installation

### 1. Cloner le projet
```bash
git clone https://github.com/zinebfajr-byte/ensaj_parking.git
cd ensaj_parking
```

### 2. Installer les dépendances
```bash
composer install
```

### 3. Configurer l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurer la base de données
Modifier le fichier `.env` :
```env
DB_DATABASE=parking_ensaj
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Créer les tables
```bash
php artisan migrate
```

### 6. Lancer le serveur
```bash
php artisan serve
```

L'API sera disponible sur `http://127.0.0.1:8000/api`

## 🗄️ Base de données
Importer le fichier `parking_ensaj.sql` dans phpMyAdmin pour avoir la structure + données de test.

## 📡 Routes API

### Authentification
| Méthode | URL | Description |
|---------|-----|-------------|
| POST | /api/register | Inscription |
| POST | /api/login | Connexion |
| POST | /api/logout | Déconnexion |

### Places de parking
| Méthode | URL | Description |
|---------|-----|-------------|
| GET | /api/parking-spots | Liste toutes les places |
| POST | /api/parking-spots | Créer une place (Admin) |
| PUT | /api/parking-spots/{id} | Modifier une place (Admin) |
| DELETE | /api/parking-spots/{id} | Supprimer une place (Admin) |

### Réservations
| Méthode | URL | Description |
|---------|-----|-------------|
| GET | /api/reservations | Liste les réservations |
| POST | /api/reservations | Créer une réservation |
| PUT | /api/reservations/{id} | Modifier le statut (Admin) |
| DELETE | /api/reservations/{id} | Annuler une réservation |

### Utilisateurs
| Méthode | URL | Description |
|---------|-----|-------------|
| GET | /api/users | Liste les utilisateurs (Admin) |
| PUT | /api/users/{id} | Modifier le rôle (Admin) |
| DELETE | /api/users/{id} | Supprimer un utilisateur (Admin) |

## 👥 Rôles
- **Admin** — accès complet (CRUD places, gestion réservations, gestion utilisateurs)
- **User** — voir les places, faire et annuler ses réservations

## 👩‍💻 Réalisé par
- Zineb Fajr
- Salma Joumail