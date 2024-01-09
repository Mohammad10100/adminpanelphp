<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h3> Welcome 
        <?php
    if (isset($_GET['login'])) {
        $username= $_GET['messege'];
        echo $username;
    }
    ?>
    </h3>
</body>


</html>