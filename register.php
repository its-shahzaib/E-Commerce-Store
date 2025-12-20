<?php
include 'db.php';

if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password

    // Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "Email already registered. <a href='index.html'>Go Back</a>";
    } else {
        // Insert new user
        $insert = mysqli_query($conn, "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
        if ($insert) {
            echo "Registration successful! <a href='index.html'>Login Now</a>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    echo "Please fill in all fields. <a href='index.html'>Go Back</a>";
}
?>
