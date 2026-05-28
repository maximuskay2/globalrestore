# PHP `intl` on XAMPP (macOS)

Laravel and Filament use `Illuminate\Support\Number::format()`, which normally requires the **intl** extension.

## If PECL failed (your case)

`sudo pecl install intl` often fails on XAMPP because:

1. **Wrong PECL package** — PECL may download `intl-3.0.0` (PHP 7 era). That code uses `TSRMLS_DC` and does not build on PHP 8.2.
2. **ICU path left blank** — When prompted `Specify where ICU libraries and headers can be found`, you must enter Homebrew’s ICU path, not press Enter on `DEFAULT`.
3. **XAMPP’s pkg-config** — Build can pick `/Applications/XAMPP/xamppfiles/bin/pkg-config` and miss ICU headers (`unicode/ubrk.h not found`).

**This project includes a fallback** (`app/Support/IntlNumberShim.php`) so the admin panel works **without** intl. After `composer install`, reload the admin.

Verify fallback:

```bash
/Applications/XAMPP/xamppfiles/bin/php -r "require 'vendor/autoload.php'; echo Illuminate\Support\Number::format(12345);"
```

Should print `12,345` with no error.

---

## Optional: build intl from PHP 8.2 source (matches XAMPP)

Use the **same PHP version** as XAMPP (8.2.4), not PECL’s old tarball.

```bash
ICU="/opt/homebrew/opt/icu4c"
PHP_VERSION="8.2.4"
EXT_DIR="/Applications/XAMPP/xamppfiles/lib/php/extensions/no-debug-non-zts-20220829"

cd /tmp
curl -LO "https://www.php.net/distributions/php-${PHP_VERSION}.tar.gz"
tar xzf "php-${PHP_VERSION}.tar.gz"
cd "php-${PHP_VERSION}/ext/intl"

export PATH="/opt/homebrew/bin:$PATH"
export PKG_CONFIG_PATH="${ICU}/lib/pkgconfig"
export CPPFLAGS="-I${ICU}/include"
export LDFLAGS="-L${ICU}/lib"

/Applications/XAMPP/xamppfiles/bin/phpize
./configure \
  --with-php-config=/Applications/XAMPP/xamppfiles/bin/php-config \
  --with-icu-dir="${ICU}"
make -j4
sudo cp modules/intl.so "${EXT_DIR}/"
```

Add to `/Applications/XAMPP/xamppfiles/etc/php.ini`:

```ini
extension=intl
```

Restart Apache, then:

```bash
/Applications/XAMPP/xamppfiles/bin/php -m | grep intl
```

When `intl` is loaded, Laravel uses the real `Number` class from the framework (the shim does nothing).

---

## Production

Always enable `intl` on production/staging PHP (standard on most Linux hosts).
