<?php

// Read and parse routes.json
$routes = json_decode(file_get_contents('routes.json'), true);

// Split the path on / and take the last one
$path = $_SERVER['REQUEST_URI'];

// Remove the first /
$path = substr($path, 1);

// Get where the path leads to
$destination = $routes[$path];

// Redirect to the destination
header('Location: ' . $destination);