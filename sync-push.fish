#!/usr/bin/env fish

set RSYNC /opt/homebrew/bin/rsync
set REMOTE kirby-remote
set REMOTE_PATH kirby
set LOCAL_PATH (realpath (dirname (status filename)))

set OPTS --dry-run
if test "$argv[1]" = --go
    set OPTS
else
    echo ">>> TROCKENLAUF – mit --go wirklich hochladen"
end

$RSYNC -avz --delete $OPTS \
    --iconv=UTF-8-MAC,UTF-8 \
    --exclude '.git*' --exclude '.DS_Store' \
    --exclude '/content/' --exclude '/media/' --exclude '/storage/' \
    --exclude '/site/accounts/' --exclude '/site/sessions/' \
    --exclude '/site/cache/' --exclude '/site/logs/' \
    --exclude '/site/config/config.localhost.php' \
    --exclude 'node_modules/' \
    $LOCAL_PATH/ \
    $REMOTE:$REMOTE_PATH/