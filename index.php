<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Simple Router
require 'views/partials/header.php';
// Include the helper file for handling requests
require_once __DIR__.'/helpers/request.php';
include './data/db.php';
// Switch statement to handle different routes based on the path from the URL
switch ($url['path']) {
        // Case: Root path '/'
    case '/':
        // Check if the HTTP method is GET
        if ($method == 'GET') {
            // Include the 'views/index.php' file for the root path
            require 'controllers/PokedexController.php';
            index();
        }
        break;

        // Case: Handle other paths
    case '/pokemon':
        // Check if the HTTP method is GET
        if ($method == 'GET') {
            // Parse the query string of the URL and store the result in the 'result' array
            parse_str($url['query'], $result);
            // Check if the 'pokemon' parameter is set in the query string
            if (isset($result['name']) && !empty($result['name'])) {

                // If 'pokemon' parameter is set, include the 'views/show.php' file
                require 'controllers/ShowController.php';
                require 'views/show.php';
                show();

            } else {
                // If 'pokemon' parameter is not set, include the 'views/errors/404.php' file
                require '/views/errors/404.php';
                // Set HTTP response code to 404 Not Found
                http_response_code(404);
            }
        }
        break;
        // Case: Handle /favorites path
    case '/register':
        // Check if the HTTP method is GET
        if ($method == 'GET') {
            // Include the 'FavoritesController.php' file
            require 'views/register.php';
        } else {
            // If the HTTP method is not GET, include the 'views/errors/404.php' file
            require 'views/errors/404.php';
            // Set HTTP response code to 404 Not Found
            http_response_code(404);
        }
        break;

        // Case: Handle /myaccount path
    case '/myAccount':
        // Check if the HTTP method is GET
        if ($method == 'GET') {
            // Include the 'account.php' file that contains the function
            require 'views/myAccount.php';
            // Call the function to display the my account page

        } else {
            // If the HTTP method is not GET, include the 'views/errors/404.php' file
            require 'views/errors/404.php';
            // Set HTTP response code to 404 Not Found
            http_response_code(404);
        }
        break;

    case '/favorites':
        // Check if the HTTP method is GET
        if ($method == 'GET') {
            // Include the 'FavoritesController.php' file
            require 'controllers/favorites.php';
            // Call the function to display the favorites page
            favorites();
        } else {
            // If the HTTP method is not GET, include the 'views/errors/404.php' file
            require 'views/errors/404.php';
            // Set HTTP response code to 404 Not Found
            http_response_code(404);
        }    

        // Default case: Handle all other paths
    default:
        // Include the 'views/errors/404.php' file for unknown paths
        require 'views/errors/404.php';
        // Set HTTP response code to 404 Not Found
        http_response_code(404);
        break;
}

include 'views/partials/footer.php';
