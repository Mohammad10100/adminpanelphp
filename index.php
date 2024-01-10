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
    
    <div class="container">
        <div class="bg">
            <span class="left "></span>
            <span class="right "></span>
        </div>
        <div class="center">
            <div class="foreground">
                <span class="left fg_left">
                    <div class="forms">
                    <form id="signupForm" action="./auth/signup.php" method="POST" style="display:none">
                        <p class="messegehead"></p>
                        <h2>Sign Up</h2>
                        <input type="text" name="username" placeholder="Enter Username" required>

                        <input type="password" name="password" placeholder="Enter Password" required>

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
                        <p class="messegehead"></p>
                        <h2>Login</h2>
                        <input type="text"  name="username" placeholder="Your Username" required>

                        <input type="password" name="password" placeholder="Your Password" required>

                        <button type="submit">Login</button>
                    </form>
                    </div>
                    <a id="switchForm" href="#">
                    <p>Don't have an account yet? <span>Sign Up!</span></p>
                    </a>
                </span>
                <span class="right fg_right">
                    <img id="foregroundimg" src="./images/foregroundimg.png" alt="">
                </span>
            </div>
        </div>
    </div>

</body>
<script>
    $("#switchForm").click(function(){
        console.log('clicked');
        const isLoginVisible = $("#loginForm").is(':not(:hidden)');
        if(isLoginVisible) {
          $("#loginForm").hide();
          $("#signupForm").show();
          $(".messegehead").hide();
          $("#switchForm > p").html("Already member? Login now!");
        } else {
          $("#loginForm").show();
          $("#signupForm").hide();
          $(".messegehead").hide();
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
                $(".messegehead").show();
                $(".messegehead").html("Regestration successfull, please login").css("color", "green");;
                </script>
            <?php
        }
        else if($status == 403){
            ?>
            <script>
                $("#loginForm").hide();
                $("#signupForm").show();
                // $("#switchForm").show();
                $("#switchForm > p").html("Already member? Login now!");
                $(".messegehead").show();
                $(".messegehead").html("password must contain all the required character.").css("color", "red");;
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
                $(".messegehead").show();
                $(".messegehead").html('Username already exists, choose a different username').css("color", "red");
            </script>
            <?php                 
        }else{
            ?>
            <script>
                $("#loginForm").hide();
                $("#signupForm").show();
                $("#passwordValidation").css("color", "black");
                $("#switchForm > p").html("Already member? Login now!");
                $(".messegehead").show();
                $(".messegehead").html('Internal Server Error, Please try again after some times').css("color", "red");
            </script>
            <?php            
        }
    }
    if (isset($_GET['login'])) {
        $messege = $_GET['messege'];
        $success = $_GET['success'];
        $status = $_GET['status'];
        if ($success==true) {
                //TODO: Do something?
        }
        else if($status == 400){
            ?>
            <script>
                $("#loginForm").show();
                $("#signupForm").hide();
                $(".messegehead").show();
                $(".messegehead").html("All fields are required").css("color", "red");
                </script>
            <?php            
        }else if($status == 401){
            ?>
            <script>
                // $("#loginForm").show();
                // $("#signupForm").hide();
                $("#switchForm > p").html("Not yet a member? Register now!");
                $(".messegehead").show();
                $(".messegehead").html('Invalid Credentials').css("color", "red");
            </script>
            <?php            
        }else if($status == 404){
            ?>
            <script>
                // $("#loginForm").show();
                // $("#signupForm").hide();
                $("#switchForm > p").html("Not yet a member? Register now!");
                $(".messegehead").show();
                $(".messegehead").html('User Not Found').css("color", "red");
            </script>
            <?php            
        }else{
            ?>
            <script>
                $("#loginForm").show();
                $("#signupForm").hide();
                $("#switchForm > p").html("Not yet a member? Register now!");
                $(".messegehead").show();
                $(".messegehead").html('Internal Server Error, Please try again after some times').css("color", "red");
            </script>
            <?php            
        }
    }
    ?>
</html>