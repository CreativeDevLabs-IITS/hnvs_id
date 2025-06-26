<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Allow API routes
    'allowed_methods' => ['*'], // Allow all HTTP methods
    'allowed_origins' => ['*'], // Allow requests from any domain (change if needed)
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Allow all headers
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];

