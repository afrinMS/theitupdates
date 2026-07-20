# Hostinger Deployment Checklist

## Before Upload

1. Set Hostinger PHP to 8.2 or newer.
2. Upload the project root, including `app`, `public`, `system`, `writable`, `.htaccess`, `composer.json`, and `spark`.
3. Do not upload local `.env` files with development credentials.
4. Upload public assets that are needed by the site, especially:
   - `public/images/books/images`
   - `public/images/books/pdf`
   - `public/uploads`
   - `public/lander`, if campaign landers are used

## Hostinger File Layout

Recommended layout when Hostinger points the domain to `public_html`:

```text
public_html/
  .htaccess
  app/
  public/
  system/
  writable/
  composer.json
  spark
  .env
```

This project includes a root `.htaccess` that internally routes requests into `public/`, so `/public` should not appear in browser URLs.

## Production `.env`

Create `.env` in the project root on Hostinger from `.env.example`.

Required values:

```ini
CI_ENVIRONMENT = production
app.baseURL = 'https://yourdomain.com/'
app.forceGlobalSecureRequests = true
database.default.hostname = localhost
database.default.database = your_hostinger_database_name
database.default.username = your_hostinger_database_user
database.default.password = your_hostinger_database_password
encryption.key = your_generated_key
cookie.secure = true
cookie.httponly = true
cookie.samesite = Lax
```

Generate the encryption key locally or over SSH:

```bash
php spark key:generate
```

## Composer

If Hostinger SSH is available, run:

```bash
composer install --no-dev --optimize-autoloader
php spark optimize
```

If SSH is not available, run Composer locally with the same command and upload the generated `vendor/` directory.

## Database

1. Create a MySQL database and user in Hostinger hPanel.
2. Import your database dump or run migrations:

```bash
php spark migrate
```

3. Insert the first admin account if it is not already present.
4. Change the default admin password immediately after first login.

## Permissions

Ensure these directories are writable by PHP:

```text
writable/cache
writable/logs
writable/session
public/uploads
public/images/books/images
public/images/books/pdf
public/images/iframe
```

Typical Hostinger permissions are `755` for directories and `644` for files. Use more permissive values only if PHP cannot write uploads/logs.

## Post-Deploy Checks

1. Visit `/`, `/admin`, `/whitepaper-library`, and one public whitepaper page.
2. Test admin login.
3. Test contact/publish/subscribe forms.
4. Upload one image and one PDF from the admin panel.
5. Confirm emails are sent through SMTP.
6. Confirm `https://yourdomain.com/.env`, `/app`, `/system`, `/writable`, and `/composer.json` are blocked.
