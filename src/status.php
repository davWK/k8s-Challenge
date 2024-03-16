<?php
$dbHost = getenv('DB_HOST');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$dbName = getenv('DB_NAME');

$link = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

if ($link) {
    $res = mysqli_query($link, "select * from products LIMIT 1;");
    if ($res) {
        http_response_code(200);
        echo "Application is healthy";
    } else {
        http_response_code(500);
        echo "Application is not healthy: unable to query the database";
    }
} else {
    http_response_code(500);
    echo "Application is not healthy: unable to connect to the database";
}