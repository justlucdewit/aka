<?php

// Read and parse routes.json
$routes = json_decode(file_get_contents('routes.json'), true);

// Remove the first / of the request URI
$path = substr($_SERVER['REQUEST_URI'], 1);

// If the path does not exist in the routes, redirect to 404 page
if (!isset($routes[$path])) {
    header('Location: /404.html');
    exit;
}

// Get where the path leads to
$destination = $routes[$path];

// Redirect to the destination
header('Location: ' . $destination);

