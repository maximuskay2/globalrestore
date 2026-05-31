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

## 7. Media uploads (important)

Railway filesystem is **ephemeral** — uploaded images are lost on redeploy unless you:

- Attach a **Railway Volume** mounted at `/app/storage/app/public`, or
- Switch `FILESYSTEM_DISK` to S3 (recommended for production).

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
