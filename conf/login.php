<?php
    include 'connection.php';
    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $query = "SELECT * FROM user_info WHERE email='$email' AND password='$pass'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0) {
            header('Location: ../home.php');
        } else {
            echo "<script>
                window.location.href='../index.php?eror';
                alert('Invalid Email or Password');
                </script>";
        }
    }
?>