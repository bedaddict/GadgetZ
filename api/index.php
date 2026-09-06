<?php

// Paksa Vercel dan Laravel pakai folder /tmp untuk semua urusan cache & view
$_SERVER['VIEW_COMPILED_PATH'] = '/tmp';
$_SERVER['APP_CONFIG_CACHE'] = '/tmp/config.php';
$_SERVER['APP_EVENTS_CACHE'] = '/tmp/events.php';
$_SERVER['APP_PACKAGES_CACHE'] = '/tmp/packages.php';
$_SERVER['APP_ROUTES_CACHE'] = '/tmp/routes.php';
$_SERVER['APP_SERVICES_CACHE'] = '/tmp/services.php';

// Lanjut panggil file utama Laravel
require __DIR__ . '/../public/index.php';