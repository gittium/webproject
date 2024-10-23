<?php 

    $servername = "localhost";
    $username = "root";
    $password = "12345678";
    $projectDB = "projectweb";

    // Create Connection
    $conn = mysqli_connect($servername, $username, $password, $projectDB);

    // Check connection
    if (!$conn) {
        die("Connection failed" . mysqli_connect_error());
    } 

?>