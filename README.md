# PHP fejlesztő tesztfeladat
###### v2025.03.24.13

---

## Minimum requirements

- PHP 8.0
- MySQL 7
- Smarty 3
- Bootstrap 5
- Composer 2

---

## How to install?

1. clone source code from GitHub
1. copy `.env.dist` to `.env` and modify
1. run `composer install` command
1. generate autoloading files with `composer dump-autoload -o`
1. point domain name to `public` directory
1. init database with `action=createDatabase` URL GET parameter, eg. `http://localhost/?action=createDatabase`

+1 optional: load demo data with `action=loadDemoData` URL GET parameter, eg. `http://localhost/?action=loadDemoData`
 
---

## Feladatkiírás

Készíts egy egyszerű blog rendszert az alábbiak szempontok szerint:

Felületek:
- Guest felület:
  - A főoldalon időrendben visszafelé listázott publikált posztok (cím, első bekezdés, szerző, publikálás dátuma).
  - A teljes poszt külön oldalon megtekinthető.

- Admin felület:
  - Bejelentkezés aktív felhasználóként (logout is).
  - Az Admin felületen 2 egyszerű CRUD-ra van szükség:
    - Felhasználók kezelése
    - Blog posztok kezelése

Használandó technológiák:
- PHP - objektum orientált programozás
- Composer használata, PSR-4 autoloading
- MySQL - PHP PDO bővítmény segítségével
- Smarty - Az admin és guest oldalak is sablonok segítségével legyenek renderelve
- Bootstrap - A dizájnt nem kell túlzásba vinni

Egyéb PHP web framework és DB library / ORM nem használható!

Az elkészítés során fordíts kiemelt figyelmet a biztonsági szempontokra!

Példa adatbázis struktúra (tetszőlegesen módosítható):

```mysql
CREATE TABLE users (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    email    VARCHAR(253) NOT NULL UNIQUE,
    password VARCHAR(72) NOT NULL,
    is_active TINYINT DEFAULT 1
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    update_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    publish_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

Beadás módja:
- publikus GitHub repository
- minimális dokumentáció a beüzemelés módjáról
- SQL szerkezet opcionális tesztadatokkal.
