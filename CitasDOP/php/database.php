<?php
	$servername =  "localhost";
    $username   =  "cita";
    $password   =  "citaDOP";
    $dbname = "citaDOP";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn){ die("Connection failed: " . mysqli_connect_error());}
?>
