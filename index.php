<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        <?php include './css/style.css' ?>
    </style>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<body>

    <a id="switchForm" href="#">
        <p>Not yet a member? Register now!</p>
    </a>
    <p id="messegehead"></p>
    <div class="forms">
    <form id="signupForm" action="./auth/signup.php" method="POST" style="display:none">
        <h2>Sign Up</h2>
        <label for="signupUsername">Username:</label>
        <input type="text" name="username" required>

        <label for="signupPassword">Password:</label>
        <input type="password" name="password" required>

        <p id="messegebottom"></p>

        <span class="passwordValidation" style="margin:'0px'; font-size: 0.9rem;" >Ensure your password meets the following criteria:</span>
        <div class="container">
            <ul>
                <li>At least 8 characters long</li>
                <li>Contains at least one uppercase letter</li>
                <li>Contains at least one lowercase letter</li>
                <li>Includes at least one numerical digit</li>
                <li>Includes at least one special character</li>
            </ul>   
        </div>

        <button type="submit">Sign Up</button>
    </form>

    <form id="loginForm" action="./auth/login.php" method="POST">
        <h2>Login</h2>
        <label for="loginUsername">Username:</label>
        <input type="text"  name="username" required>

        <label for="loginPassword">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
    </div>

</body>
<script>
    $("#switchForm").click(function(){
        console.log('clicked');
        const isLoginVisible = $("#loginForm").is(':not(:hidden)');
        if(isLoginVisible) {
          $("#loginForm").hide();
          $("#signupForm").show();
          $("#switchForm > p").html("Already member? Login now!");
        } else {
          $("#loginForm").show();
          $("#signupForm").hide();
          $("#messegehead").hide();
          $("#switchForm > p").html("Not yet a member? Register now!");
        }
      })
</script>
<?php
    if (isset($_GET['signup'])) {
        $messege = $_GET['messege'];
        $success = $_GET['success'];
        $status = $_GET['status'];
        if ($success==true) {
            ?>
            <script>
                $("#loginForm").show();
                $("#switchForm").hide();
                $("#messegehead").html("Regestration successfull, please login")..css("color", "green");;
            </script>
            <?php
        }
        else if($status == 403){
            ?>
            <script>
                $("#passwordValidation").css("color", "red");
                </script>
            <?php            
        }else if($status == 409){
            ?>
            <script>
                $("#loginForm").hide();
                $("#signupForm").show();
                $("#passwordValidation").css("color", "black");
                $("#switchForm > p").html("Already member? Login now!");
                $("#messegehead").html('Username already exists, choose a different username').css("color", "red");
            </script>
            <?php            
        }else if($status == 409){
            ?>
            <script>
                $("#loginForm").hide();
                $("#signupForm").show();
                $("#passwordValidation").css("color", "black");
                $("#switchForm > p").html("Already member? Login now!");
                $("#messegehead").html('Internal Server Error, Please try again after some times').css("color", "red");
            </script>
            <?php            
        }
    }
    ?>
</html>