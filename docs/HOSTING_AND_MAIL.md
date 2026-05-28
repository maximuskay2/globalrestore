# Hosting, SSL & email — client checklist

Items for **Phase 0** sign-off before production launch.

## Domain & SSL

- [ ] Register production domain (e.g. `restoreglobalinitiative.com`)
- [ ] Point DNS A/AAAA records to hosting provider
- [ ] Enable HTTPS (Let’s Encrypt or host panel SSL)
- [ ] Set `APP_URL=https://your-domain.com` in production `.env`
- [ ] Set `ASSET_URL` to match `APP_URL`
- [ ] Point web server **document root** to `public/` (recommended)

## Email delivery

Choose one provider and configure `.env`:

| Provider | Typical variables |
|----------|-------------------|
| SMTP (host panel) | `MAIL_MAILER=smtp`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD` |
| Mailgun | `MAIL_MAILER=mailgun` + Mailgun API keys |
| Postmark | `MAIL_MAILER=postmark` + Postmark token |

Also set:

- `MAIL_FROM_ADDRESS=info@restoreglobalinitiative.com`
- `MAIL_FROM_NAME="Restore Global Initiative"`

### DNS records (deliverability)

- [ ] SPF record authorising your mail server
- [ ] DKIM signing enabled with provider
- [ ] DMARC policy (start with `p=none` for monitoring)

## Queue worker (contact emails)

Contact notifications are queued. On production:

```bash
php artisan queue:work --tries=3
```

Use Supervisor, systemd, or your host’s process manager to keep the worker running.

## Hero headline

Default approved copy is seeded:

> Empowering Communities Through Green Skills, Clean Energy, and Climate Action

Update in **Admin → Site settings** when the client supplies final wording.

## Analytics (optional)

In `.env`:

```env
ANALYTICS_PROVIDER=ga4
GA_MEASUREMENT_ID=G-XXXXXXXXXX
```

Or for Plausible:

```env
ANALYTICS_PROVIDER=plausible
PLAUSIBLE_DOMAIN=restoreglobalinitiative.com
```

Leave `ANALYTICS_PROVIDER=none` until ready.
