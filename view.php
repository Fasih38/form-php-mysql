<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formdata3";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM data";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Data</title>
    <link rel="stylesheet" href="styles.css">
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
            width: 700px;
            margin: 50px auto;
        }
        .btn{
       padding: 5px;
       background-color: red;
       color: rgb(155, 255, 68);
       text-decoration: none;
        }
        .btn-margin{
            display : inline-block;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class='container'>
    <table border="1" style='border-collapse: collapse;'>
        <tr>
            <!-- <th>ID</th> -->
             <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Country</th>
            <th>Gender</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            foreach ($result as $key => $row) { 
                echo "<tr>";
                // echo "<td>" . $row["id"] . "</td>";
                echo "<td>". "<img src='uploads/".$row['filename']."' width='auto' height='150'>". "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["country"] . "</td>";
                echo "<td>" . $row["gender"] . "</td>";
                echo "<td>
                        <a class='btn btn-margin' href='update.php?id=" . $row["id"] . "'>Update</a> 
                        <a class='btn' href='delete.php?id=" . $row["id"] . "'>Delete</a>
                      </td>";
                echo "</tr>";
                }
        

        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    </br>

    <a href="index.html" class='btn'>Back to Form</a></div>
</body>
</html>
