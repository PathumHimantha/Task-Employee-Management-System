<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "Project";

  $conn = mysqli_connect($servername,$username,$password,$database);

  // Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
  $eid=$_POST["eid"];
  $tid=$_POST["tid"];
  $date=$_POST["date"];
  $aid=$_POST["aid"];
  $remarks=$_POST["remarks"];


  $sql= "INSERT INTO assign VALUES('$eid','$tid','$date','$aid','$remarks')";


  if (mysqli_query($conn, $sql)) {
    echo "New record submitted successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }


mysqli_close($conn);
?>