<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$eid = $_POST["eid"];
$telephone = $_POST["telephone"];
$name = $_POST["name"];
$email = $_POST["email"];
$designation = $_POST["designator"];

$conn = mysqli_connect ("localhost", "root", "", "project");

$sql = "INSERT INTO employee VALUES ('$eid', '$telephone', '$name', '$email', '$designation')";

if (mysqli_query ($conn, $sql)){
	echo "New record created succesfully";
	}
	else{
	echo "Error:".$sql."<br>".mysqli_error($conn);
	}
mysqli_close ($conn);
?>