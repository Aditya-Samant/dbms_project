<?php
include 'db.php';
session_start();

$srno = $_SESSION['coordinator'];

// Initialize the WHERE clause for the search
$whereClause = "c.srno = $srno";

// Check if a search term is provided
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $searchTerm = $con->real_escape_string($_POST['search']);
    
    // Add conditions for each column you want to search
    $whereClause .= " AND (
        c.cname LIKE '%$searchTerm%' OR
        ev.name LIKE '%$searchTerm%' OR
        ev.date LIKE '%$searchTerm%' OR
        u.first LIKE '%$searchTerm%' OR
        u.last LIKE '%$searchTerm%' OR
        u.phoneno LIKE '%$searchTerm%'
    )";
}

// Your MySQL query
$query = "SELECT c.cname, ev.name, ev.date, u.first, u.last, u.phoneno
          FROM coordinators as c
          JOIN events as ev ON c.srno = ev.cid
          JOIN enrolled as en ON ev.id = en.taskid
          JOIN users as u ON en.uid = u.srno
          WHERE $whereClause
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
    
    <h1>Enrolled Events</h1>

    <!-- Search Form -->
    <form action="" method="post" class="search-form">
                <input type="text" id="search" placeholder="search" name="search">
                <button type="submit"></button>
    </form>
    <div class="move">
    <div class="tbl-header">
        <table cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr>
                    <th>Coordinator</th>
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="tbl-content">
        <table cellpadding="0" cellspacing="0" border="0">
            <tbody>
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
                ?>     
            </tbody>
        </table>
        <?php
        echo "<center> <h3>No user.</h3> </center>";
        }
        ?> 
    </div>
    </div>
</body>
</html>
