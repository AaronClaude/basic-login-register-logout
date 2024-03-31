<?php
require 'config.php';
if (isset($_POST["submit"])) {
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$usernameemail' OR '$usernameemail' ");
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        if ($password == $row["password"]) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: index.php");
        } else {
            echo
            "<script> alert ('Wrong Password'); </script>";
        }
    } else {
        echo
        "<script> alert ('User Not Registered'); </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>

<body>
    <h2>login</h2>
    <form class="" method="post" autocomplete="off">
        <label for="usernameemail">Username or Email: </label>
        <input type="text" name="usernameemail" id="usernameemail" required> <br>

        <label for="password">Password: </label>
        <input type="password" name="password" id="password" required> <br>

        <button type="submit" name="submit">Login</button>
    </form>
    <a href="register.php">Register now!</a>
</body>

</html>