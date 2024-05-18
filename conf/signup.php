<?php
    include 'connection.php';
    if(isset($_POST['signup'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $query = "INSERT INTO user_info(email, password) VALUES('$email','$pass');";
        $result = mysqli_query($conn, $query);
        if($result) {
            header("Location: ../index.php");
        } else {
            echo "Failed to Sign Up!";
        }
    }
?>