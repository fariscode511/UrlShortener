<?php

$db = new Framework\Database();

$utils = new Framework\Utils();

$install = new Framework\Migration($db, $utils);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $install->createTable(
        'short_urls',
        [
            ['id', 'INT(11)', 'UNSIGNED', 'NOT NULL'],
            ['long_url', 'VARCHAR(225)', 'NOT NULL'],
            ['short_code', 'VARCHAR(27)', 'NOT NULL'],
            ['password', 'VARCHAR(225)', 'NULL', 'DEFAULT NULL'],
            ['hits', 'INT(11)', 'NOT NULL', 'DEFAULT 0'],
            ['created', 'TIMESTAMP', 'NOT NULL', 'DEFAULT CURRENT_TIMESTAMP']
        ]
    );

    $install->isPrimary("short_urls", "id");

    $install->isAutoinc("short_urls", ['id', 'INT(11)', 'UNSIGNED', 'NOT NULL']);
    
    // Enable Production Mode
    /* -------------------------- */
    $env_file = APP_PATH . "config/environment.php";

    $env_file_content = file_get_contents($env_file);

    $env_file_content = preg_replace("/installation/", "production", $env_file_content, 1);

    file_put_contents($env_file, $env_file_content);
    /* -------------------------- */

    $msg = "Software has been installed";
}
