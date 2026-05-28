# Restore Global Initiative — Website

Custom Laravel 12 application with Filament admin for the Restore Global Initiative UK CIC.

## Requirements

- PHP 8.2+ (8.3+ recommended; enable `ext-intl` for Filament)
- Composer
- Node.js 20+

## PHP version note (macOS)

If you have **Homebrew PHP 8.4+** on your PATH, prefer **XAMPP’s PHP** for Artisan so it matches Apache:

```bash
/Applications/XAMPP/xamppfiles/bin/php artisan serve
```

Homebrew PHP 8.5 can turn `tempnam()` warnings into fatal errors when Laravel renders debug pages, unless `storage/` is writable (see `bootstrap/runtime.php`).

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

- **Public site:** http://127.0.0.1:8000  
- **Admin panel:** http://127.0.0.1:8000/admin  

### Default admin accounts (change after first login)

| Role | Email | Password (from `.env`) |
|------|--------|-------------------------|
| Admin | `ADMIN_EMAIL` | `ADMIN_PASSWORD` |
| Editor | `EDITOR_EMAIL` | `EDITOR_PASSWORD` |

Defaults: `admin@restoreglobalinitiative.com` / `editor@restoreglobalinitiative.com` — password `ChangeMeNow!`

## Development

```bash
composer dev
```

Or run `php artisan serve` and `npm run dev` in separate terminals.

## Brand assets

Source logo: `logo.jpeg` · Web assets: `public/images/brand/` · Tokens: `config/brand.php` and `assets/brand/brand-tokens.json`

## Mail

Contact form submissions are stored in the database and queued to the address in **Site settings** (seeded as `info@restoreglobalinitiative.com`). Configure `MAIL_*` in `.env` for production and run `php artisan queue:work` when `QUEUE_CONNECTION` is not `sync`.

## Media library

Upload images in **Admin → Media library**. Use slug `home-hero` on the homepage via the `<x-media-image slug="home-hero" />` component. Run `php artisan storage:link` once after deploy.

## News, newsletter & analytics

- **Public news:** `/news` (manage posts in Admin → News & blog)
- **Newsletter:** footer signup form; subscribers in Admin (admin only)
- **Analytics:** set `ANALYTICS_PROVIDER`, `GA_MEASUREMENT_ID`, or `PLAUSIBLE_DOMAIN` in `.env` — see [docs/HOSTING_AND_MAIL.md](docs/HOSTING_AND_MAIL.md)
- **SVG logo:** `public/images/brand/logo.svg`

## Deployment

See [docs/DEPLOYMENT.md](docs/DEPLOYMENT.md) for production checklist and handover notes.

- [docs/STAGING_UAT.md](docs/STAGING_UAT.md) — staging & client UAT
- [docs/BROWSER_TESTING.md](docs/BROWSER_TESTING.md) — browser/device testing
- [docs/HOSTING_AND_MAIL.md](docs/HOSTING_AND_MAIL.md) — domain, SSL, email, analytics
