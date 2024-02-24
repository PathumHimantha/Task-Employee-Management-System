<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$Tid = $_POST["Tid"];
$std = $_POST["std"];
$ed = $_POST["ed"];
$nature = $_POST["nature"];

$conn = mysqli_connect ("localhost", "root", "", "project");

$sql = "INSERT INTO task VALUES ('$Tid', '$std', '$ed', '$nature')";

if (mysqli_query ($conn, $sql)){
	echo "New Task created succesfully";
	}
	else{
	echo "Error:".$sql."<br>".mysqli_error($conn);
	}
mysqli_close ($conn);




?>