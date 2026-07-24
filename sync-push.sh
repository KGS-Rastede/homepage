#!/usr/bin/env bash
set -euo pipefail

RSYNC=$(which rsync)
REMOTE=kirby-remote
REMOTE_PATH=kirby
LOCAL_PATH="$(cd "$(dirname "$0")/.." && pwd)"
DRY="${1:---dry-run}"

"$RSYNC" -avz $DRY --delete \
  --iconv=UTF-8-MAC,UTF-8 \
  --exclude '.git*' \
  --exclude '.DS_Store' \
  --exclude '/content/' \
  --exclude '/media/' \
  --exclude '/storage/' \
  --exclude '/site/accounts/' \
  --exclude '/site/sessions/' \
  --exclude '/site/cache/' \
  --exclude '/site/logs/' \
  --exclude '/site/config/config.localhost.php' \
  --exclude '/bin/' \
  --exclude 'node_modules/' \
  "$LOCAL_PATH/" \
  "$REMOTE:$REMOTE_PATH/"
