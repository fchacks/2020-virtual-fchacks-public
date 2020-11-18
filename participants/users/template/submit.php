<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../login.php");
    exit;
}
if ($_SESSION["username"] !== basename(dirname(__FILE__))) {
    header("location: ../../welcome.php");
    exit;
  }
?>

<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $uploadOk = 1;
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "<b>Sorry, file already exists.</b><br>";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "<b>Sorry, your file is too large.</b><br>";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<b>Sorry, your file was not uploaded.</b><br>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<b>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</b><br>";
        } else {
        echo "<b>Sorry, there was an error uploading your file.</b><br>";
        }
    }
}


?>

<!DOCTYPE html>
<html>
<body>

<form action="submit.php" method="post" enctype="multipart/form-data">
  Select file to upload:<br>
  <input type="file" name="fileToUpload" id="fileToUpload"><br>
  <input type="submit" value="Upload" name="submit">
</form>
<br><br>
Current files uploaded:<br>
<?php
if ($handle = opendir('./uploads/')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            echo "<a href='uploads/$entry'>$entry</a><br>\n";
        }
    }

    closedir($handle);
}
?>


</body>
</html>