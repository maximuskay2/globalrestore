# Staging deploy & client UAT

## Staging deploy steps

1. Clone/upload code to staging server; document root → `public/`
2. Copy `.env.example` → `.env`; set `APP_ENV=staging`, `APP_DEBUG=true` (or `false` for production-like)
3. Run `composer install --no-dev --optimize-autoloader`
4. Run `php artisan key:generate`, `migrate --force`, `db:seed` (first time only)
5. Run `php artisan storage:link`, `npm ci && npm run build`
6. Run `php artisan config:cache`, `route:cache`, `view:cache`
7. Start queue worker for contact form emails
8. Change default admin/editor passwords

## UAT script (client / QA)

| # | Task | Pass? |
|---|------|-------|
| 1 | Open home page — hero, CTAs, footer CIC statement | |
| 2 | About — three mission sections display | |
| 3 | Services — accordion opens each pillar | |
| 4 | News — list and open a sample article | |
| 5 | Contact — submit form; confirm success message | |
| 6 | Admin — log in; edit site settings (admin only) | |
| 7 | Admin — editor can edit mission/services/news; **cannot** access users or settings | |
| 8 | Admin — contact submissions visible to admin only | |
| 9 | Footer newsletter — subscribe with test email | |
| 10 | Mobile layout — navigation menu works | |

## Issues log

| Date | Page | Issue | Status |
|------|------|-------|--------|
| | | | |

## Sign-off

| Role | Name | Date |
|------|------|------|
| Client | | |
| Developer | | |
