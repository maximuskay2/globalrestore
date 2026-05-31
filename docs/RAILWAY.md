# Deploy GlobalRestore to Railway (production)

Repo: [github.com/maximuskay2/globalrestore](https://github.com/maximuskay2/globalrestore)

## 1. Create the Railway project

1. Open [Railway](https://railway.com) and sign in.
2. **New Project** → **Deploy from GitHub repo** → select `maximuskay2/globalrestore`.
3. Railway builds from the included `Dockerfile` and starts via `scripts/railway-start.sh`.

Or with CLI (logged in as `maximuskay2@gmail.com`):

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/GlobalRestore
railway init --name globalrestore
railway link
railway up
```

## 2. Add MySQL

In the Railway project:

1. **+ New** → **Database** → **MySQL**.
2. On the **web service**, open **Variables** and add:

```env
DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
```

Replace `MySQL` with your MySQL service name if different.

## 3. Required environment variables (web service)

Generate `APP_KEY` locally: `php artisan key:generate --show`

```env
APP_NAME="Restore Global Initiative"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_KEY_HERE
APP_URL=https://YOUR-RAILWAY-DOMAIN.up.railway.app
ASSET_URL=${{APP_URL}}

LOG_CHANNEL=stderr
LOG_LEVEL=info

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
FILESYSTEM_DISK=public

MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@restoreglobalinitiative.com
MAIL_FROM_NAME="${APP_NAME}"

ADMIN_EMAIL=admin@restoreglobalinitiative.com
ADMIN_PASSWORD=ChangeMeNow!
EDITOR_EMAIL=editor@restoreglobalinitiative.com
EDITOR_PASSWORD=ChangeMeNow!

ANALYTICS_PROVIDER=none
```

## 4. First deploy tasks

After the first successful deploy:

```bash
railway run php artisan db:seed --class=SiteContentSeeder
railway run php artisan db:seed --class=AdminUserSeeder
```

Change admin passwords immediately in `/admin`.

## 5. Queue worker (contact form emails)

Add a **second service** from the same repo:

- **Start command:** `php artisan queue:work --sleep=3 --tries=3 --max-time=3600`
- Copy the same env vars as the web service (especially `DB_*`, `APP_KEY`, `MAIL_*`).

Or use the `Procfile` worker process if your plan supports multiple processes.

## 6. Custom domain

1. Railway service → **Settings** → **Networking** → **Generate domain** (or add custom domain).
2. Update `APP_URL` and `ASSET_URL` to `https://your-domain.com`.
3. Redeploy.

## 7. Media uploads & admin updates

### How it works in production

| What you change in `/admin` | Stored in | Survives redeploy? |
|-----------------------------|-----------|-------------------|
| Page text, headlines, URLs | MySQL database | Yes |
| Image / video file paths | MySQL database | Yes |
| Uploaded files (hero, news, videos) | `storage/app/public` | **Only with a Volume** (see below) |

After the first deploy, **admin edits are not overwritten** by code deploys. Seeders only run on a completely fresh database (no users yet).

Default/baseline images ship in `database/seed-media/` and are copied into storage **only if missing** — they never replace files you uploaded in admin.

### One-time setup: persistent uploads (required for admin media)

Without this, uploads work until the next deploy, then images break.

1. Railway project → **web** service → **Settings** → **Volumes**
2. **Add Volume** → mount path: `/app/storage/app/public`
3. Redeploy the web service

After that, anything you upload in Filament (hero images, news photos, video thumbnails, etc.) is kept permanently.

### Updating media as admin (day-to-day)

1. Log in at `https://YOUR-DOMAIN/admin`
2. Edit **Site Settings**, **Home Video Slides**, **News**, or **Media Assets**
3. Upload or replace files in the form → **Save**
4. Changes appear on the live site immediately — no git push needed

### Updating baseline media via code (optional)

To change the *default* shipped images (e.g. before first go-live):

1. Add/replace files under `database/seed-media/` locally (same folder structure as storage paths)
2. Update seeders if paths change
3. Push to GitHub — deploy copies missing files only

## 8. Health check

Laravel exposes `/up` — configured in `railway.toml` for deploy health checks.

## Troubleshooting

| Issue | Fix |
|-------|-----|
| 500 on admin | Ensure `APP_KEY` is set; check deploy logs |
| Filament number errors | `intl` is installed in the Dockerfile |
| CSS/JS missing | Build runs `npm run build` on deploy |
| DB connection failed | Verify `${{MySQL.*}}` variable references |
| Contact email not sent | Run queue worker service; configure SMTP |
