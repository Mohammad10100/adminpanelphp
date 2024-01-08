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
        exit();
    }


    // atleast 
    // 1 number , 1 special character, 1 small alphabet, 1 capitol alphabet, must be greater than 8 and smaller than 20
    if (!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$password)) {
        echo 'Password must qualify all the required critera.';
        exit();
    }

    
    // hashing
    // TODO: hashing, salting
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // query
    $sql = "INSERT INTO user (username, password) VALUES ('$username', '$hashedPassword')";        
    if ($conn->query($sql) === TRUE) {
        echo 'Signup successful!';
        // redirect to login
        header("Location: ../index.php");
        exit();
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }
    
    echo "done";

    //close connection
    mysqli_close($conn);


}

?>