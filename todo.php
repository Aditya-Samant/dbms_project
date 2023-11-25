<?php
include('db.php');
session_start();
$uid=$_SESSION['srno'];
if(!isset($_SESSION['srno'])){
    header("index.php");
}
//Check if the form is submitted
if (isset($_POST['task'])) {
    
// Get the task from the form
    $task = $_POST['task'];
    // Insert the task into the database
    $sql = "INSERT INTO `todo` (`uid`,`task_name`) VALUES ('$uid','$task')";
    $result = $con->query($sql);
    header('Location:todo.php');
    if (!$result) {
        die("Error: " . $con->error);
    }
}

//Fetch tasks from the databasex
$sql = "SELECT * FROM todo where  uid={$uid}";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Todo List</h1>
        <form action="todo.php" method="POST">
            <input type="text" name="task" placeholder="Add a new task" required>
            <button type="submit">Add</button>
        </form>
        <ul>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li>{$row['task_name']}</li>";
                }
            }
            ?>
        </ul>
    </div>
</body>
</html>

<?php
$con->close();
?>