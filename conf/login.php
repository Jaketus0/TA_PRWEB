<?php
    include 'connection.php';
    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $query = "SELECT * FROM user_info WHERE email='$email' AND password='$pass'";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) > 0) {
            session_start();
            $_SESSION['email'] = $data['email'];
            $_SESSION['password'] = $data['password'];
            setcookie("email", $data['email'], time() + 3600);
            setcookie("password", $data['password'], time() + 3600);
            header("location:../home.php");
        } else {
            echo "<script>
                window.location.href='../index.php?eror';
                alert('Invalid Email or Password');
                </script>";
        }
    }
?>