<?php

function getDatabaseConnection(): mysqli {
    $servername = 'localhost'
    $username = 'root';

    $conn = new mysqli(hostname:$servername, username:$username,
    password:$password, database:$dbname);

    if($conn->connect_error) {
        die("Connection failed:". $conn-> connect_error);
    }
    return $conn;

}

// Test the Connection
$conn = getDatabaseConnection();
if ($conn) {
    echo "Connected Succesfully";
}
?>