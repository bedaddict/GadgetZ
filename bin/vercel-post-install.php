<?php

// Runs after `composer install` on every Vercel build. No-op outside Vercel
// (Vercel sets VERCEL=1 during build), so local `composer install` is unaffected.
if (getenv('VERCEL')) {
    passthru('php artisan migrate --force', $exitCode);
    exit($exitCode);
}
