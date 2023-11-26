<?php
include 'db.php';
session_start();

$srno = $_SESSION['coordinator'];

// Your MySQL query
$query = "SELECT c.cname, ev.name, ev.date, u.first, u.last, u.phoneno
          FROM coordinators as c
          JOIN events as ev ON c.srno = ev.cid
          JOIN enrolled as en ON ev.id = en.taskid
          JOIN users as u ON en.uid = u.srno
          WHERE c.srno = $srno
          ORDER BY ev.name";

$result = $con->query($query);

// Check if the query was successful
if ($result) {
    // Fetch associative array
    $rows = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // Handle the case when the query fails
    echo "Error executing the query: " . $con->error;
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/co_home.css">
    <title>Enrolled Events</title>
</head>
<body>
    <div class="container">
        <h1>Enrolled Events</h1>
        <table border="1">
            <tr>
                <th>Coordinator</th>
                <th>Event Name</th>
                <th>Date</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
            </tr>
            <?php
            // Check if there are rows in the result
            if (isset($rows) && !empty($rows)) {
                foreach ($rows as $row) {
                    echo "<tr>";
                    echo "<td>{$row['cname']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['date']}</td>";
                    echo "<td>{$row['first']}</td>";
                    echo "<td>{$row['last']}</td>";
                    echo "<td>{$row['phoneno']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No user has enrolled for your events.</td></tr>";
            }
            ?>
        </table>
        <br>
        <a href="home.php">Return Home</a>
    </div>
</body>
</html>
            