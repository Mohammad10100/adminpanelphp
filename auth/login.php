<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];


    // must not be empty
    if(empty($username) || empty($password)){
        echo 'All fields are required.';
        echo json_encode(["status" => 400, "success" => false, "messege" => 'All fields are required.']);

        $response = array(
            'success' => false,
            'login' => true,
            'status' => 400,
            'messege' => 'All fields are required',
        );

        // Convert the data to a query string
        $queryString = http_build_query($response);
        // redirect to login
        header("Location: ../index.php?$queryString");
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
            echo json_encode(["status" => 200,"success" => true,"messege" => 'Login successful!']);
            $response = array(
                'success' => true,
                'login' => true,
                'status' => 200,
                'messege' => $username,
            );
    
            // Convert the data to a query string
            $queryString = http_build_query($response);

            // redirect
            header("Location: ../dashboard.php?$queryString");
            exit();
        } else {
            echo 'Invalid Credentials';
            echo json_encode(["status" => 401, "success" => false, "messege" => 'Invalid Credentials']);

            $response = array(
                'success' => false,
                'status' => 401,
                'login' => true,
                'messege' => 'Invalid Credentials',
            );
    
            // Convert the data to a query string
            $queryString = http_build_query($response);
            // redirect to login
            header("Location: ../index.php?$queryString");
            exit();
        }
    }else if($result->num_rows === 0){
        echo json_encode(["status" => 404, "success" => false, "message" => 'User not found']);

        $response = array(
            'success' => false,
            'status' => 404,
            'login' => true,
            'messege' => 'User Not Found',
        );

        // Convert the data to a query string
        $queryString = http_build_query($response);
        // redirect to login
        header("Location: ../index.php?$queryString");
        exit();
    } else {
        echo json_encode(["status" => 500, "success" => false, "message" => 'Internal Server Error']);

        $response = array(
            'success' => false,
            'status' => 500,
            'login' => true,
            'messege' => 'Internal Server Error',
        );

        // Convert the data to a query string
        $queryString = http_build_query($response);
        // redirect to login
        header("Location: ../index.php?$queryString");
        exit();
    }
    

    //close connection
    mysqli_close($conn);



//     // TODO: 
//     // PATH DIRECTORY
}

?>