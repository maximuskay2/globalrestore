#!/usr/bin/env bash
set -euo pipefail

SEED_DIR="/app/database/seed-media"
TARGET_DIR="/app/storage/app/public"

if [ ! -d "$SEED_DIR" ]; then
  echo "No bundled seed media found at $SEED_DIR — skipping."
  exit 0
fi

mkdir -p "$TARGET_DIR"
cp -rf "$SEED_DIR/." "$TARGET_DIR/"
echo "==> Synced bundled media to storage/app/public"
