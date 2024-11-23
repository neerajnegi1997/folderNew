<?php
function getDatabaseConnection(): mysqli{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname ='itlab20';

    $conn = new mysqli(hostname: $servername, username: $username, password: $password, database: $dbname);

    if ($conn->connect_error) {
        die("connection failed: ". $conn->connect_error);
            }
            return $conn;
}
$conn = getDatabaseConnection();
if ($conn){
    echo "connected successfully";
}
?>