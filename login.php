<?php
session_start();
include 'db.php';

if (isset($_POST['email'], $_POST['password'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Fetch user from DB
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            // Login successful → store user info in session
            $_SESSION['user_id'] = $user['user_id']; // correct column
            $_SESSION['user'] = $user['name'];       // for greeting

            header("Location: index.php"); // redirect to main e-commerce page
            exit();
        } else {
            echo "Incorrect password. <a href='index.html'>Try Again</a>";
        }
    } else {
        echo "Email not found. <a href='index.html'>Register</a>";
    }
} else {
    echo "Please fill in all fields. <a href='index.html'>Go Back</a>";
}
?>