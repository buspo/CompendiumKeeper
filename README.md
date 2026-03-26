# CompendiumKeeper

## Overview
This project is built using Laravel, incorporating both the default Laravel template and a custom character sheet template from the Reddit community.

## Technologies Used
- Laravel Framework
- PHP
- HTML/CSS/JavaScript

## Setup Produzione

1. Clona il repository ed entra nella cartella del progetto:

```bash
git clone https://github.com/buspo/CompendiumKeeper.git
cd CompendiumKeeper
```

2. Crea il file ambiente partendo dal template:

```bash
cp .env.example .env
```

3. Completa il file `.env` con i valori di produzione, ad esempio:
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL` con il dominio corretto
- credenziali database (`DB_*`)

4. Genera la chiave dell'applicazione:

```bash
php artisan key:generate
```

5. Installa i pacchetti Composer:

```bash
composer install --no-dev --optimize-autoloader
```

6. Avvia lo stack di produzione:

```bash
docker compose -f compose.prod.yaml up -d --build
```

7. Verifica lo stato dei container:

```bash
docker compose -f compose.prod.yaml ps
```

Nota: se non hai PHP/Composer installati sulla macchina host, puoi eseguire i passaggi Artisan/Composer tramite container dedicati.

## Licenses and Credits

### 5E Character Sheet Template
The character sheet template used in this project was sourced from the Reddit community. To comply with proper attribution and usage rights:

1. Original Source: [Reddit post from r/DnD](https://www.reddit.com/r/DnD/comments/fvxsgj/5e_html_character_sheet_for_5e_with_basic/?rdt=63294)
2. Original Author: u/BackFromOtterSpace, u/nevertras, u/ConDar15

## Disclaimer
This project is provided "as is" without warranty of any kind, either express or implied. Users are responsible for ensuring their use complies with all applicable licenses and terms of service.
