<?php

require_once './config/app.php';
require_once './helpers/print_html.php';
require_once './helpers/send_request.php';


print_html(sendRequest('setWebhook', [
    'url' => WEBHOO_URL,
]));
