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

$addedActivities = []; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add"])) {
        $tid = $_POST["tid"];
        $activity = $_POST["activity"];
        
        $addedActivities[] = array(
            "tid" => $tid,
            "activity" => $activity,
        );
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Assigning</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<center>
<div class="d-flex justify-content-center">
    <form id="activity-form" action="assgnTask.php" method="POST" class="p-4 bg-light rounded">
        <center><h2 style="color: #007bff;">Activities</h2></center>
        <table class="form-table">
            <tr>
                <td class="form-label">Task ID  </td>
                <td>
                    <select name="tid" id="tid" class="form-control">
                        <?php
                        // dropdown with Task IDs from the database
                        $sql = "SELECT tid FROM task";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["tid"] . "'>" . $row["tid"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="form-label">Activity  </td>
                <td><input type="text" name="activity" class="form-control"/></td>
            </tr>
        </table>
        <button type="button" name="add" id="add" class="btn btn-success">Add</button>
    </form>
</div>
<br><br>
<div class="table-container">
    <table class="table">
        <thead class="mx-auto">
            <tr>
                <th>Task ID</th>
                <th>Activity</th>
                
            </tr>
        </thead>
        <tbody id="activity-table-body" class="mx-auto">
            
        </tbody>
    </table>
    <button type="submit" name="submit" id="submit" class="btn btn-primary">Save DB</button>
</div>
</center>

<script>
$(document).ready(function () {
    var addedActivities = []; 

    $("#add").click(function () {
        var tid = $("#tid").val();
        var activity = $("input[name='activity']").val();

        var newActivity = {
            "tid": tid,
            "activity": activity
        };

        addedActivities.push(newActivity);

        $("input[name='activity']").val("");

        refreshTable();
    });

    function refreshTable() {
        var tableBody = $("#activity-table-body");
        tableBody.empty(); 

        for (var i = 0; i < addedActivities.length; i++) {
            var data = addedActivities[i];
            var row = "<tr><td>" + data.tid + "</td><td>" + data.activity + "</td></button></td></tr>";
            tableBody.append(row);
        }

        $(".delete-btn").click(function () {
            var index = $(this).data("index");
            addedActivities.splice(index, 1);
            refreshTable(); 
        });
    }

    $("#submit").click(function () {
        $.ajax({
            type: "POST",
            url: "assgnTask.php",
            data: { "addedActivities": addedActivities },
            success: function (response) {
                if (response === "success") {
                    alert("Data submitted successfully!");
                    addedActivities = [];
                    refreshTable();
                } else {
                  alert("Data submitted successfully!");
                    addedActivities = [];
                    refreshTable();
                }
            },
            error: function (xhr, status, error) {
                // Handle AJAX errors
                alert("AJAX Error: " + error);
            }
        });
    });
});

</script>
</body>
</html>
