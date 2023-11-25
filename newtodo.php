<?php
include 'db.php';
session_start();

function getTodos($search = null) {
    global $con;
    $todos = array();
    $uid = $_SESSION['srno'];

    $sql = "SELECT * FROM todo WHERE uid={$uid}";

    // If search term is provided, include it in the query
    if ($search !== null) {
        $search = mysqli_real_escape_string($con, $search);
        $sql .= " AND (task_name LIKE '%$search%' OR task_desc LIKE '%$search%' OR task_category LIKE '%$search%' )";
    }

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $todos[] = $row;
        }
    }

    return $todos;
}

if (isset($_GET['edit'])) {
    $uid = $_SESSION['srno'];
    $task_id = $_GET['edit'];
    $result = $con->query("SELECT * FROM todo WHERE uid=$uid AND task_id=$task_id");

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $edit_task_name = $row['task_name'];
        $edit_task_desc = $row['task_desc'];
        $edit_task_date = $row['task_date'];
        $edit_task_category = $row['task_category'];
    }
}

if (isset($_GET['delete'])) {
    $uid = $_SESSION['srno'];
    $task_id = $_GET['delete'];
    $con->query("DELETE FROM todo WHERE uid='$uid' AND task_id='$task_id'");
}

if (isset($_POST['todoAction'])) {
    $uid = $_SESSION['srno'];
    $task_name = $_POST['task_name'];
    $task_desc = $_POST['task_desc'];
    $task_date = $_POST['task_date'];
    $task_category = $_POST['task_category'];

    if (isset($_POST['edit_task_id'])) {
        $task_id = $_POST['edit_task_id'];
        $sql = "UPDATE todo SET task_name='$task_name', task_desc='$task_desc', task_date='$task_date', task_category='$task_category' WHERE uid=$uid AND task_id=$task_id";
    } else {
        $sql = "INSERT INTO todo (uid, task_name, task_desc, task_date, task_category) VALUES ('$uid', '$task_name', '$task_desc', '$task_date', '$task_category')";
    }

    $con->query($sql);
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/newtodo.css">
    <title>Todo List</title>
</head>
<body>
    <div class="container">
        <div class="add-todo">
            <h1>Todo List</h1>

            <!-- Form to add or edit a todo -->
            <form action="" method="post" class="todo-form">
                <?php if (isset($edit_task_name)) : ?>
                    <!-- Editing an existing task -->
                    <input type="hidden" name="edit_task_id" value="<?php echo $task_id; ?>">
                    <label for="task_name">Task Name:</label>
                    <input type="text" id="task_name" name="task_name" value="<?php echo $edit_task_name; ?>" required>
                    <label for="task_description">Task Description:</label>
                    <textarea id="task_desc" name="task_desc" required><?php echo $edit_task_desc; ?></textarea>
                    <label for="task_date">Task Date:</label>
                    <input type="date" id="task_date" name="task_date" value="<?php echo $edit_task_date; ?>" required>
                    <label for="task_category">Task Category:</label>
                    <input type="text" id="task_category" name="task_category" value="<?php echo $edit_task_category; ?>" required>
                    <button type="submit" name="todoAction">Update Todo</button>
                <?php else : ?>
                    <!-- Adding a new task -->
                    <label for="task_name">Task Name:</label>
                    <input type="text" id="task_name" name="task_name" required>
                    <label for="task_description">Task Description:</label>
                    <textarea id="task_desc" name="task_desc" required></textarea>
                    <label for="task_date">Task Date:</label>
                    <input type="date" id="task_date" name="task_date" required>
                    <label for="task_category">Task Category:</label>
                    <input type="text" id="task_category" name="task_category" required>
                    <button type="submit" name="todoAction">Add Todo</button>
                <?php endif; ?>
            </form>

            <!-- Search bar and button -->
            <form action="" method="post" class="search-form">
                <input type="text" id="search" placeholder="search" name="search">
                <button type="submit">Search</button>
            </form>
        </div>

        <!-- Display todos from the database -->
        <ul class="todo-list">
            <?php
                $searchTerm = isset($_POST['search']) ? $_POST['search'] : null;
                $todos = getTodos($searchTerm);
                foreach ($todos as $todo) {
                    echo "<li>";
                    echo "<strong>{$todo['task_name']}</strong><br>";
                    echo "<em>{$todo['task_desc']}</em><br>";
                    echo "<span>{$todo['task_date']}</span><br>";
                    echo "<span>{$todo['task_category']}</span><br>";
                    echo "<a href='?edit={$todo['task_id']}'>Edit</a> ";
                    echo "<a href='?delete={$todo['task_id']}' id='f2'>Delete</a>";
                    echo "</li>";
                }
            ?>
        </ul>
    </div>
</body>
</html>

<?php
$con->close();
?>
