#!/usr/bin/env bash
set -euo pipefail

SEED_DIR="/app/database/seed-media"
TARGET_DIR="/app/storage/app/public"

if [ ! -d "$SEED_DIR" ]; then
  echo "No bundled seed media found at $SEED_DIR — skipping."
  exit 0
fi

mkdir -p "$TARGET_DIR"
# -n = never overwrite: admin uploads and replacements are kept across redeploys.
cp -rn "$SEED_DIR/." "$TARGET_DIR/" 2>/dev/null || true
echo "==> Ensured default media exists in storage/app/public (existing files kept)"
