<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];


    // must not be empty
    if(empty($username) || empty($password)){
        echo 'All fields are required.';
        exit();
    }

    
    // database connection
    require '../includes/connection.php';
    
    // sanitizing username from sql injection possibilities
    $username = mysqli_real_escape_string($conn, $username);


    // VERIFY USER
    // Find username and get hashed passowrd of the user
    $getUserQuery = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($getUserQuery);
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];
        
        // verify password
        if (password_verify($password, $hashedPassword)) {
            echo 'Login successful!';
            // redirect
            // header("Location: dashboard.php");
            exit();
        } else {
            echo 'Invalid Credentials.';
        }
    } else {
            echo 'Invalid Credentials.';
    }
    

    //close connection
    mysqli_close($conn);



//     // TODO: 
//     // PATH DIRECTORY
}

?>