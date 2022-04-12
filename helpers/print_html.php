<?php

/**
 * The function prints some data beautifully into HTML
 * 
 * @param array $data
 * 
 * @return void
 */
function print_html(array $data) : void
{
    echo '<pre>' . var_export($data, true) . '</pre>';
}
