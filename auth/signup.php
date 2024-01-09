<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];


// validation 
    // must not be empty
    if(empty($username) || empty($password)){
        echo 'All fields are required.';
        echo json_encode(["status" => 400, "success" => false, "messege" => 'All fields are required.']);
        exit();
    }

    // database connection
    require '../includes/connection.php';

    // sanitizing username from sql injection possibilities
    $username = mysqli_real_escape_string($conn, $username);

    // Check if already exist
    $checkUsernameQuery = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($checkUsernameQuery);
    // echo $result;
    if ($result->num_rows > 0) {
        echo 'Username already exists. Choose a different username.';
        echo json_encode(["status" => 409, "success" => false, "messege" => "Username already exists. Choose a different username."]);
        
        $response = array (
            'success' => false,
            'signup' => true,
            'status' => 409,
            'messege' => 'Username already exists. Please choose a differrent username.',
        );
        $queryString = http_build_query($response);

        header("Location: ../index.php?$queryString");
        exit();
    }



    // atleast 
    // 1 number , 1 special character, 1 small alphabet, 1 capitol alphabet, must be greater than 8 and smaller than 20
    if (!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$password)) {
        echo 'Password must qualify all the required critera.';
        echo json_encode(["status" => 400, "success" => false, "messege" => "password must contain all the required character"]);
        $response = array (
            'success' => false,
            'signup' => true,
            "status" => 403,
            'messege' => 'password must contain all the required character',
        );
        $queryString = http_build_query($response);

        header("Location: ../index.php?$queryString");
        exit();
    }

    
    // hashing
    // TODO: hashing, salting
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // query
    $sql = "INSERT INTO user (username, password) VALUES ('$username', '$hashedPassword')";        
    if ($conn->query($sql) === TRUE) {
        echo 'Signup successful!';
        echo json_encode(["status" => 200, "success" => true, "messege" => 'Signup successful!']);

        // Your data to be sent
        $response = array(
            'success' => true,
            'signup' => true,
            'messege' => 'Signup Successful',
        );

        // Convert the data to a query string
        $queryString = http_build_query($response);
        // redirect to login
        header("Location: ../index.php?$queryString");
        exit();
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
        $response = array(
            'success' => false,
            'status' => 500,
            'signup' => true,
            'messege' => 'Internal Server Error',
        );

        // Convert the data to a query string
        $queryString = http_build_query($response);
        // redirect to login
        header("Location: ../index.php?$queryString");
        exit();
    }
    
    echo "done";

    //close connection
    mysqli_close($conn);


}

?>