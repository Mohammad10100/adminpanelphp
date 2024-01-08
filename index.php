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

<body>

    <form id="signupForm" action="./auth/signup.php" method="POST">
        <h2>Sign Up</h2>
        <label for="signupUsername">Username:</label>
        <input type="text" name="username" required>

        <label for="signupPassword">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Sign Up</button>
    </form>

    <form id="loginForm" action="./auth/login.php" method="POST" style="margin-left: 20px;">
        <h2>Login</h2>
        <label for="loginUsername">Username:</label>
        <input type="text"  name="username" required>

        <label for="loginPassword">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

</body>

</html>