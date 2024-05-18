<?php
    $conn = mysqli_connect("localhost", "root", "", "ticket_web");
    if(!$conn) {
        die("Connection Failed: ".mysqli_connect_error());
    }
?>