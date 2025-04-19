<?php
// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airlinesystem";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user ID is set and not empty
if (isset($_POST['id']) && !empty($_POST['id'])) {
    // Get the user ID from the POST request
    $userId = $_POST['id'];

    // Prepare the delete query
    $sql = "DELETE FROM signupinfo WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Bind the user ID to the query
    $stmt->bind_param("i", $userId);

    // Execute the query
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo 'error';
}
?>
