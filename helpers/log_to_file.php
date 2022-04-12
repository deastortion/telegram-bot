<?php

/**
 * Store some data in a local file
 * 
 * @param string $file
 * @param mixed $data
 * @param bool $append
 * 
 * @return bool
 */

function log_to_file(string $file, $data, bool $append = false): bool
{
    return file_put_contents($file, '$data: ' . print_r($data, true) . '\n', $append ? FILE_APPEND : null);
}
