<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'secret');//Therealking1$$
define('DB_DATABASE', 'nizkor');
// define('DB_DATABASE', 'nizkor');

function dbconnect () {
    static $conn;
    if ($conn===NULL){ 
        $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        // mysqli_set_charset("utf8");
        mysqli_set_charset($conn,"utf8");
        // $conn->set_charset("utf8mb4");
    }
    return $conn;
}


