#!/usr/bin/env bash
set -euo pipefail

RSYNC=/opt/homebrew/bin/rsync
REMOTE=kirby-remote
REMOTE_PATH=kirby
LOCAL_PATH="$(cd "$(dirname "$0")/.." && pwd)"

OPTS=()
if [[ "${1:-}" == "-n" || "${1:-}" == "--dry-run" ]]; then
  OPTS+=(--dry-run)
  echo ">>> TROCKENLAUF – es wird nichts geschrieben"
fi

"$RSYNC" -avz --delete "${OPTS[@]}" \
  --iconv=UTF-8-MAC,UTF-8 \
  --exclude '.DS_Store' \
  "$REMOTE:$REMOTE_PATH/content/" \
  "$LOCAL_PATH/content/"

if [[ ${#OPTS[@]} -eq 0 ]]; then
  echo "--- Git-Status ---"
  cd "$LOCAL_PATH" && git status --short
fi
