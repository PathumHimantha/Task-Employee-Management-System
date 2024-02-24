<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Project";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["addedActivities"])) {
        // Get the addedActivities array from the POST data
        $addedActivities = $_POST["addedActivities"];

        // Get the last activityId from the database
        $sql = "SELECT MAX(act_id) AS maxact_id FROM task_activities";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $lastact_id = $row["maxact_id"];

        // Initialize a variable to track insertion success
        $insertSuccess = true;

        // Start with the next activityId
        $nextact_id = $lastact_id + 1;

        foreach ($addedActivities as $data) {
            $tid = $data["tid"];
            $activity = $data["activity"];

            // Insert data into the database using the nextActivityId
            $sql = "INSERT INTO task_activities (act_id, tid, activity) VALUES ('$nextact_id', '$tid', '$activity')";
            if (!mysqli_query($conn, $sql)) {
                $insertSuccess = false;
                echo "Error inserting data: " . mysqli_error($conn);
                break; // Exit the loop on the first error
            }

            // Increment the nextActivityId for the next activity
            $nextact_id++;
        }

        // Send a JSON response indicating success or failure
        if ($insertSuccess) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error"]);
        }
    }
}

mysqli_close($conn);
?>
