<?php
// file upload

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//  Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

//  Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}


// file upload
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formdata3";
// Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

$name = $_POST['name'];
$email = $_POST['email'];
$country=$_POST['country'];
$gender=$_POST['gender'];
// $filename = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
$filename =  $_FILES["fileToUpload"]["name"];

// $sql = "INSERT INTO data (`name`, `email`,`country`,`gender`,`filename`) VALUES ('$name', '$email','$country','$gender','$filename')";
$sql = "INSERT INTO `data`(`name`, `email`, `country`, `gender`, `filename`) VALUES ('$name','$email','$country','$gender','$filename')";
// echo $sql;

// if ($conn->query($sql) === TRUE) {
//     echo "New record created successfully";
//     header("Location: view.php");
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

// 

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
        header("Location: view.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  
}

// $conn->close();
mysqli_close($conn);
?>
