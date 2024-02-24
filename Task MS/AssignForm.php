<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Project";

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Assign Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        center {
            margin-top: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        select,
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<center>
    <form id="activity-form" action="assign.php" method="POST">
        <center><h2>Assign Task to Employee</h2></center>
        <table>
        <tr>
                <td>Employee ID</td>
                <td>
                    <select name="eid" id="eid">
                        <?php
                        // dropdown with employee ID
                        $sql = "SELECT Eid FROM employee";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["Eid"] . "'>" . $row["Eid"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Task ID</td>
                <td>
                    <select name="tid" id="tid">
                        <?php
                        //dropdown with Task ID
                        $sql = "SELECT Tid FROM task";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["Tid"] . "'>" . $row["Tid"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
            <td> Date Assigned </td>
            <td><input type="date" name="date" id="date"></td>
            </tr>
            <tr>
                <td>Activity ID</td>
                <td>
                    <select name="aid" id="aid">
                        <?php
                        //dropdown with Activity ID
                        $sql = "SELECT activityid FROM taskactivities";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["activityid"] . "'>" . $row["activityid"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Remarks</td>
                <td><input type="text" name="remarks" /></td>
            </tr>
        </table>
        <button type="submit" name="sub" id="sub">Assign</button>
    </form>
  
</center>
</body>
</html>
