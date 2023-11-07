<?php

$dbConfig = array(
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'project-arts'
);

$connection = new mysqli(
    $dbConfig['host'],
    $dbConfig['username'],
    $dbConfig['password'],
    $dbConfig['database']
);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}  
?>