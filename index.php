<?php
// Start the session
session_start();

// Load the router logic
require_once 'route.php';
// Load all declared routes
require_once 'routes.php';

// If no route matched, show 404 page
if (!defined('ROUTE_MATCHED')) {
    http_response_code(404);
    include 'views/404.php';
    exit();
}
