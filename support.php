<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "fosterx"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['save'])) {
    // Get form data
    $email = $_POST['email'];
    $help = $_POST['country']; // This corresponds to the help selection
    $subject = $_POST['Subject'];
    $description = $_POST['Description'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO support (email, help, subject, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $help, $subject, $description);

    if ($stmt->execute()) {
        echo "<script>alert('Data inserted successfully!');
         window.location.href = 'contact-sales.html';
        </script>";
    } else {
        echo "<script>alert('Error inserting data: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

