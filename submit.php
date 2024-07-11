<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$country=$_POST['country'];
$gender=$_POST['gender'];

$sql = "INSERT INTO data (name, email,country,gender) VALUES ('$name', '$email','$country','$gender')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: view.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
