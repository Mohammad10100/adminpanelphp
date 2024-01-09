<?php

    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "ek2teen";

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

    if (!$conn) {
        echo json_encode(["status" => 503, "success" => false, "message" => 'Bad Gateway']);
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully ";

?>