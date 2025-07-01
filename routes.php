<?php

require_once __DIR__ . '/route.php';

// Front-end pages
get('/', 'views/home.php');
get('/home', 'views/home.php');
get('/about', 'views/about.php');
get('/privacy', 'views/privacy.php');
get('/legal', 'views/legal.php');

// Consent handling (API)
post('/consent', 'models/consentModel.php');

// 404 fallback (any method, any unmatched route)
any('/404', 'views/404.php');
