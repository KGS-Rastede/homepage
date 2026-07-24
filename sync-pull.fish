#!/usr/bin/env fish

set RSYNC /opt/homebrew/bin/rsync
set REMOTE kirby-remote
set REMOTE_PATH kirby
set LOCAL_PATH (realpath (dirname (status filename)))

set OPTS
set DRYRUN 0
if contains -- -n $argv; or contains -- --dry-run $argv
    set OPTS --dry-run
    set DRYRUN 1
    echo ">>> TROCKENLAUF – es wird nichts geschrieben"
end

# Trockenlauf: ausführliche Dateiliste. Echtlauf: Fortschrittsbalken.
if test $DRYRUN -eq 1
    set VERB -avz
else
    set VERB -az --info=progress2 --human-readable
end

$RSYNC $VERB --delete $OPTS \
    --iconv=UTF-8-MAC,UTF-8 \
    --exclude '.DS_Store' \
    $REMOTE:$REMOTE_PATH/content/ \
    $LOCAL_PATH/content/
or exit 1

if test $DRYRUN -eq 0
    echo ""
    echo "--- Git-Status ---"
    cd $LOCAL_PATH; and git status --short
end