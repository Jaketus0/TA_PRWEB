<?php
    include 'conf/connection.php';
    // session_start();
    // if(!isset($_SESSION['email'])) {
    //     echo "<script>
    //         alert('You must login first!!');
    //         window.location.href='index.php';
    //         </script>";
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVH Tickets</title>
    <link rel="stylesheet" href="asset/style/style.css">
</head>
<body>
    <div id="navbar">
        <div class="container">
            <div class="logo">
                <ul>
                    <li><img src="asset/img/AVH.png" alt="Logo"></li>
                    <li><a href="home.php">Home</a></li>    
                    <li><a href="ticket.php">Ticket</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="conf/logout.php">Logout</a></li>
                    <li><input type="text" id="search"></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="artist">
        <ul class="artist-profile">
            <?php
                $sql = "SELECT * FROM artistprofile";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);
                if($count > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<li><a href='#".$row['nama_artist']."'><img src='asset/tmp/profile/".$row['pp_artist']."' alt='".$row['nama_artist']."'></a></li>";
                    }
                }
            ?>
            <!-- <li><a href="#bruno"><img src="asset/img/profile-artist/bruno_mars.png" alt="bruno"></a></li>
            <li><a href="#daniel"><img src="asset/img/profile-artist/daniel.png" alt="daniel"></a></li> -->
        </ul>
    </div>
</body>
<script src="asset/js/script.js"></script>
</html>