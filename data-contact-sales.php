<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "fosterx"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['save'])) {
    // Get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $company_name = $_POST['company_name'];
    $country = $_POST['country'];
    $agency = $_POST['marketing_agency'];
    $notes = $_POST['notes'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO contact_sales (First_Name, Last_Name, Email, Phone_Number, `Company Name`, Country, agency, Notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $first_name, $last_name, $email, $phone, $company_name, $country, $agency, $notes);

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
