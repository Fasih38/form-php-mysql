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
//  Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  if($_POST['fileToUpload']){

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    // upload file
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
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

}

// upload file

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $country=$_POST['country'];
    $gender=$_POST['gender'];
    // $filename = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
    $filename =  $_FILES["fileToUpload"]["name"];

    $sql = "UPDATE data SET name='$name', email='$email',country='$country',gender='$gender',filename ='$filename' WHERE id=$id";
    // echo $sql;
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
    <form action="update.php?id=<?php echo $row['id'] ?>"  method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>
        <label for="country">Country</label>
      <select name="country" id="country" name="country">
        <option value="Pakistan" <?php if($row['country'] == 'Pakistan'){  echo 'selected'; } ?>>Pakistan</option>
        <option value="India"  <?php if($row['country'] == 'India'){  echo 'selected'; } ?>>India</option>
        <option value="Uk"  <?php if($row['country'] == 'Uk'){  echo 'selected'; } ?>>Uk</option>
        </select>
        <br/><br/>
      <label for="gender">Gender:</label>
      <label for="male">Male</label>
      <input type="radio" <?php if($row['gender'] == 'Male'){  echo 'checked'; } ?> name="gender" id="male" value="Male" required />
      <label for="female">Female</label>
      <input <?php if($row['gender'] == 'Female'){  echo 'checked'; } ?>
        type="radio"
        name="gender"
        id="female"
        value="Female"
        required
      /><br /><br />
      <!-- file upload -->
      <input
          type="file"
          name="fileToUpload"
          id="fileupload"
          placeholder="fileupload"
        />
        <br /><br />
        <input type="submit" name="submit" value="Update" class='btn'>
    </form>
    </br>
    <a href="view.php" class='btn'>Back to Data</a></div>
</body>
</html>
