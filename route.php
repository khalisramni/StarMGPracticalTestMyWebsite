<?php

/**
 * Register GET route
 */
function get($route, $path_to_include) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        route($route, $path_to_include);
    }
}

/**
 * Register POST route
 */
function post($route, $path_to_include) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        route($route, $path_to_include);
    }
}

/**
 * Register PUT route
 */
function put($route, $path_to_include) {
    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        route($route, $path_to_include);
    }
}

/**
 * Register PATCH route
 */
function patch($route, $path_to_include) {
    if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
        route($route, $path_to_include);
    }
}

/**
 * Register DELETE route
 */
function delete($route, $path_to_include) {
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        route($route, $path_to_include);
    }
}

/**
 * Register ANY route
 */
function any($route, $path_to_include) {
    route($route, $path_to_include);
}

/**
 * Core routing logic
 */
function route($route, $path_to_include) {
    $route = rtrim($route, '/');
    $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
    $request_url = rtrim($request_url, '/');
    $request_url = strtok($request_url, '?'); // Remove query string

    $route_parts = explode('/', $route);
    $request_url_parts = explode('/', $request_url);

    array_shift($route_parts);
    array_shift($request_url_parts);

    // Handle root "/"
    if (empty($route_parts) && count($request_url_parts) === 0) {
    include_once($path_to_include);
    define('ROUTE_MATCHED', true);
    exit();
    }


    if (count($route_parts) !== count($request_url_parts)) {
        return;
    }

    $parameters = [];

    for ($i = 0; $i < count($route_parts); $i++) {
        $route_part = $route_parts[$i];
        $request_part = $request_url_parts[$i];

        if (preg_match('/^\$/', $route_part)) {
            $param_name = ltrim($route_part, '$');
            $parameters[$param_name] = $request_part;
            $$param_name = $request_part;
        } elseif ($route_part !== $request_part) {
            return;
        }
    }

    // Callable handler
    if (is_callable($path_to_include)) {
        call_user_func($path_to_include, $parameters);
        define('ROUTE_MATCHED', true);
        exit();
    }

    // File include fallback
    if (file_exists($path_to_include)) {
        include_once($path_to_include);
        define('ROUTE_MATCHED', true);
        exit();
    } else {
        error_log("Route error: File not found – $path_to_include");
    }
}

/**
 * Escape output
 */
function out($text) {
    echo htmlspecialchars($text);
}

/**
 * CSRF token generator
 */
function set_csrf() {
    if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    echo '<input type="hidden" name="csrf" value="' . $_SESSION['csrf'] . '">';
}

/**
 * CSRF token validator
 */
function is_csrf_valid() {
    return isset($_SESSION['csrf'], $_POST['csrf']) && hash_equals($_SESSION['csrf'], $_POST['csrf']);
}
