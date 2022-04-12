<?php

require_once './config/app.php';

/**
 * Function sends a request to Telegram API using
 * a special method and a bunch of parameters
 * 
 * @param string $method
 * @param array $params
 * 
 * @return array
 */
function sendRequest(string $method, array $params = []): array
{
    # Set up a proper URL
    $url = BASE_URL . '/' . $method . '?' . http_build_query($params);

    # Make a request and return the response of it
    return json_decode(file_get_contents($url), true);
}
