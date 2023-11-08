<?php
$serverName = "localhost:3307"; // usually type "localhost" or see config file from xamp mysqls
$userName = "root";
$password = "";
$dbName = "test";

$conn = mysqli_connect($serverName, $userName, $password, $dbName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// CREATE operation
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO mytable (name, email) VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Record created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// READ operation
if (isset($_GET['read'])) {
    $sql = "SELECT * FROM mytable";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row['id'] . " - Name: " . $row['name'] . " - Email: " . $row['email'] . "<br>";
        }
    } else {
        echo "No records found.";
    }
}

// UPDATE operation
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $newName = $_POST['new_name'];
    $newEmail = $_POST['new_email'];

    $sql = "UPDATE mytable SET name='$newName', email='$newEmail' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// DELETE operation
if (isset($_GET['delete'])) {
    $idToDelete = $_GET['delete_id'];

    // Ensure that the ID is a valid integer to prevent SQL injection
    if (is_numeric($idToDelete)) {
        $sql = "DELETE FROM mytable WHERE id=$idToDelete";

        if ($conn->query($sql) === TRUE) {
            echo "Record with ID $idToDelete deleted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Invalid ID provided for deletion.";
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Operations</title>
</head>
<body>
    <!-- CREATE form -->
    <h2>Create Record</h2>
    <form method="post">
        Name: <input type="text" name="name">
        Email: <input type="text" name="email">
        <input type="submit" name="create" value="Create">
    </form>

    <!-- READ button -->
    <h2>Read Records</h2>
    <a href="?read">Read Records</a>

    <!-- UPDATE form -->
    <h2>Update Record</h2>
    <form method="post">
        ID: <input type="text" name="id">
        New Name: <input type="text" name="new_name">
        New Email: <input type="text" name="new_email">
        <input type="submit" name="update" value="Update">
    </form>

    <!-- DELETE form -->
    <h2>Delete Record</h2>
    <form method="get">
        ID to Delete: <input type="text" name="delete_id">
        <input type="submit" name="delete" value="Delete">
    </form>
</body>
</html>
