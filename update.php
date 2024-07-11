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

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $country=$_POST['country'];
    $gender=$_POST['gender'];

    $sql = "UPDATE data SET name='$name', email='$email',country='$country',gender='$gender' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: view.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT id, name, email ,country, gender FROM data WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Data</title>
    <style>
        table,th,td{
            border: 1px solid red;
  padding: 10px;
        }
        body{
                    background-color: rgb(155, 255, 68);
                    color:red;
        }
        .container{
            width: 400px;
            margin: 50px auto;
        }
        .btn{
padding: 5px;
background-color: red;
color: rgb(155, 255, 68);
text-decoration: none;
border: none;
        }
        input[type="text"] {
        border: 2px solid red;
        border-radius: 4px;
      }
      input[type="email"] {
        border: 2px solid red;
        border-radius: 4px;
      }
    </style>
</head>
<body>
    <div class='container'>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>
        <label for="country">Country</label>
      <select name="country" id="country" name="country">
        <option value="Pakistan">Pakistan</option>
        <option value="India">India</option>
        <option value="Uk">Uk</option></select
      ><br /><br />
      <label for="gender">Gender:</label>
      <label for="male">Male</label>
      <input type="radio" name="gender" id="male" value="Male" required />
      <label for="female">Female</label>
      <input
        type="radio"
        name="gender"
        id="female"
        value="Female"
        required
      /><br /><br />
        <input type="submit" name="update" value="Update" class='btn'>
    </form>
    </br>
    <a href="view.php" class='btn'>Back to Data</a></div>
</body>
</html>
