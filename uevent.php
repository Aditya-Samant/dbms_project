<?php
session_start(); // Move session_start to the beginning

// Include the configuration file
include 'db.php';

// Function to get events from the database
function getEvents() {
    global $con;
    $events = array();

    $sql = "SELECT * FROM events";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }

    return $events;
}

// Function to get enrolled events for a specific user
function getEnrolledEvents($uid) {
    global $con;
    $enrolledEvents = array();

    $sql = "SELECT * FROM events JOIN enrolled ON events.id = enrolled.taskid WHERE enrolled.uid = $uid";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $enrolledEvents[] = $row;
        }
    }

    return $enrolledEvents;
}

// Function to enroll a user in an event
function enroll($uid, $eventid) {
    global $con;
    $sql = "INSERT INTO enrolled (`uid`, `taskid`) VALUES ($uid, $eventid)";
    $con->query($sql);
}

// Function to check if a user is already enrolled in an event
function isEnrolled($uid, $eventid) {
    global $con;
    $sql = "SELECT * FROM enrolled WHERE uid = $uid AND taskid = $eventid";
    $result = $con->query($sql);

    return $result->num_rows > 0;
}

// Function to unenroll from a specific event
function unenrollEvent($uid, $event_id) {
    global $con;

    $deleteSql = "DELETE FROM enrolled WHERE uid = $uid AND taskid = $event_id";
    $con->query($deleteSql);
}

// Fetch events from the database
$events = getEvents();
$uid = $_SESSION['srno'];
$enrolledEvents = getEnrolledEvents($uid);

// Handle Enroll button click
if (isset($_POST['enroll'])) {
    $eventid = $_POST['event_id'];
    if (!isEnrolled($uid, $eventid)) {
        enroll($uid, $eventid);
        $_SESSION['message'] = 'Enrolled successfully!';
    } else {
        $_SESSION['message'] = 'Already Enrolled';
    }

    // Redirect back to the same page to avoid resubmission on page refresh
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Handle Unenroll button click
if (isset($_POST['unenroll'])) {
    $event_id = $_POST['event_id'];
    unenrollEvent($uid, $event_id);
    $_SESSION['message'] = 'Unenrolled successfully!';

    // Redirect back to the same page to avoid resubmission on page refresh
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/uevent.css">
    <script>
        var REPLACE_WITH_PHP_MESSAGE = "<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : '';
        unset($_SESSION['message']) ?>";
    </script>
    <script src="js/message.js" defer></script>
    <title>Events</title>
</head>
<body>
    <div class="container">
        <div class="left-container">
            <center><h1>New Events</h1></center>
            <!-- Display events in the New Event Form -->
            <form method="post" action="">
                <ul class="event-list">
                    <?php
                    foreach ($events as $event) {
                        echo "<form method='post' action=''>";
                        echo "<li class='event-card'>";
                        echo "<h2>{$event['name']}</h2>";
                        echo "<p>{$event['description']}</p>";
                        echo "<p>DATE: {$event['date']}</p>";
                        echo "<p>VENUE: {$event['location']}</p>";
                        echo "<input type='hidden' name='event_id' value='{$event['id']}'>";
                        echo "<button type='submit' name='enroll' class='enroll-btn'>Enroll</button>";
                        echo "</li>";
                        echo "</li>";
                        echo "</form>";
                    }
                    ?>
                </ul>
            </form>
        </div>

        <div class="right-container">
            <center><h1>My Events</h1></center>
            <!-- Display enrolled events in the right container -->
            <form method="post" action="">
                <ul class="event-list">
                    <?php
                    foreach ($enrolledEvents as $enrolledEvent) {
                        echo "<form method='post' action=''>";
                        echo "<li class='event-card'>";
                        echo "<h2>{$enrolledEvent['name']}</h2>";
                        echo "<p>{$enrolledEvent['description']}</p>";
                        echo "<p>DATE: {$enrolledEvent['date']}</p>";
                        echo "<p>VENUE: {$enrolledEvent['location']}</p>";
                        echo "<input type='hidden' name='event_id' value='{$enrolledEvent['id']}'>";
                        echo "<button type='submit' name='unenroll' class='unenroll-btn'>Unenroll</button>";
                        echo "</li>";
                        echo "</form>";
                    }
                    ?>
                </ul>
            </form>
        </div>
    </div>
    <?php include 'returnhome.php'; ?>
</body>
</html>
