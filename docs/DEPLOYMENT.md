# Deployment & handover — Restore Global Initiative

## Pre-launch checklist

### Server requirements

- PHP 8.2+ with extensions: `mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo`, **`intl`** (recommended for Filament)
- MySQL 8+ or MariaDB 10.3+
- Composer 2.x, Node.js 20+ (build assets once on deploy)

### Environment

1. Copy `.env.example` to `.env` and set:
   - `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://your-domain.com`
   - `DB_*` for production database
   - `MAIL_*` (SMTP, Mailgun, Postmark, etc.) — required for contact notifications
   - `QUEUE_CONNECTION=database` or `redis` (contact emails are queued)
2. Run `php artisan key:generate`
3. Run `php artisan migrate --force`
4. Run `php artisan db:seed --class=SiteContentSeeder` (first deploy only, if empty)
5. Run `php artisan storage:link` (media library uploads)
6. Run `npm ci && npm run build`
7. Run `php artisan config:cache`, `route:cache`, `view:cache`

### Default admin accounts

Change passwords immediately after first login. Seeded users are documented in `database/seeders/AdminUserSeeder.php`.

### Email deliverability

- Configure SPF, DKIM, and DMARC for the sending domain
- Set `MAIL_FROM_ADDRESS` to a monitored inbox (e.g. `info@restoreglobalinitiative.com`)
- Run a queue worker: `php artisan queue:work --tries=3`

### SSL & hosting

- Terminate TLS at the reverse proxy or host panel
- Point document root to `public/`
- Confirm `robots.txt` and sitemap if added later

## Staging UAT

1. Deploy to staging with production-like `.env`
2. Verify all four public pages and `/admin`
3. Submit test contact form; confirm DB record and email
4. Editor role: can edit mission, services, media — **not** users, site settings, or submissions
5. Admin role: full access

## Production handover

| Item | Location |
|------|----------|
| Admin panel | `/admin` |
| Brand assets | `public/images/brand/` |
| CMS content | Filament: Mission, Services, Media, Settings |
| Contact submissions | Filament → Contact submissions (admin only) |
| Project plan | `todo.md` |

## Phase 2 features (included)

| Feature | Admin | Public |
|---------|-------|--------|
| News / blog | Admin → News & blog | `/news` |
| Newsletter | Admin → Newsletter subscribers | Footer signup |
| Analytics | `.env` — see `docs/HOSTING_AND_MAIL.md` | Auto-injected when configured |
| SVG logo | — | `public/images/brand/logo.svg` |
| Sitemap / robots | — | `/sitemap.xml`, `/robots.txt` |

## Further documentation

- `docs/BROWSER_TESTING.md` — cross-browser checklist
- `docs/STAGING_UAT.md` — staging deploy & UAT script
- `docs/HOSTING_AND_MAIL.md` — domain, SSL, mail, analytics

## Deferred

- Multi-language support (future phase)
