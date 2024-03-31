<?php
require 'config.php';

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    // You need to have $conn defined before using it in mysqli_query
    $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'");

    if (!$duplicate) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script> alert ('Username or Email has already taken'); </script>";
    } else {
        if ($password == $confirmpassword) {
            $query = "INSERT INTO tb_user (name, username, email, password) VALUES ('$name', '$username', '$email', '$password')";

            if (mysqli_query($conn, $query)) {
                echo "<script> alert ('Register Successful'); </script>";
            } else {
                echo "<script> alert ('Error: " . mysqli_error($conn) . "'); </script>";
            }
        } else {
            echo "<script> alert ('Password does not match'); </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h1>Registration</h1>
    <form action="" method="post" autocomplete="off">
        <label for="name">Name: </label>
        <input type="text" name="name" id="name" required> <br>

        <label for="username">Username: </label>
        <input type="text" name="username" id="username" required> <br>

        <label for="email">Email: </label>
        <input type="email" name="email" id="email" required> <br>

        <label for="password">Password: </label>
        <input type="password" name="password" id="password" required> <br>

        <label for="confirmpassword">Confirm Password: </label>
        <input type="password" name="confirmpassword" id="confirmpassword" required> <br>

        <button type="submit" name="submit">Register</button>
    </form>
    <br>
    <p>Already have an account? <a href="login.php">Login now</a></p>
</body>

</html>