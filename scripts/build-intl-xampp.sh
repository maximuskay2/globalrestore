#!/usr/bin/env bash
# Build the intl extension for XAMPP PHP 8.2 from official PHP sources (not PECL intl 3.0.0).
set -euo pipefail

PHP_VERSION="${PHP_VERSION:-8.2.4}"
XAMPP="/Applications/XAMPP/xamppfiles"
ICU="${ICU_PREFIX:-/opt/homebrew/opt/icu4c}"
EXT_DIR="${XAMPP}/lib/php/extensions/no-debug-non-zts-20220829"
WORKDIR="${TMPDIR:-/tmp}/php-intl-build-$$"

echo "PHP: ${XAMPP}/bin/php ($("${XAMPP}/bin/php" -r 'echo PHP_VERSION;'))"
echo "ICU: ${ICU}"
echo "Extension dir: ${EXT_DIR}"

if [[ ! -d "${ICU}/include/unicode" ]]; then
  echo "ICU headers not found. Install with: brew install icu4c" >&2
  exit 1
fi

mkdir -p "${WORKDIR}"
cd "${WORKDIR}"

if [[ ! -f "php-${PHP_VERSION}.tar.gz" ]]; then
  curl -LO "https://www.php.net/distributions/php-${PHP_VERSION}.tar.gz"
fi

tar xzf "php-${PHP_VERSION}.tar.gz"
cd "php-${PHP_VERSION}/ext/intl"

export PATH="/opt/homebrew/bin:${PATH}"
export PKG_CONFIG_PATH="${ICU}/lib/pkgconfig"
export CPPFLAGS="-I${ICU}/include"
export LDFLAGS="-L${ICU}/lib"

"${XAMPP}/bin/phpize"
./configure --with-php-config="${XAMPP}/bin/php-config" --with-icu-dir="${ICU}"
make -j"$(sysctl -n hw.ncpu 2>/dev/null || echo 2)"

echo ""
echo "Built: ${WORKDIR}/php-${PHP_VERSION}/ext/intl/modules/intl.so"
echo "Install with:"
echo "  sudo cp modules/intl.so '${EXT_DIR}/'"
echo "  echo 'extension=intl' | sudo tee -a '${XAMPP}/etc/php.ini'"
echo "Then restart Apache in XAMPP."
