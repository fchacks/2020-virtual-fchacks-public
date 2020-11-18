<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["Jloggedin"]) || $_SESSION["Jloggedin"] !== true){
    header("location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../style.css">
<link rel="stylesheet" type="text/css" href="../../css/slider.css">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="../../w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<title>Teams</title>
</head>
<body>
   <script>
    $(function(){
      $("#topbar").load("../../topbar.php");
    });
    </script>
    <div id="topbar"></div><br>
  <div >
    <script> 
    $(function(){
      $("#header").load("header.html"); 
    });
    </script>
     <div id="header"></div>

<br>
<section style="padding: 5px 5px 5px 15px;">

<h2>Team Data:</h2>
</section><br>
<section> <div class="text-body" style="font-size: 20px;">
To view each team's submissions, click on their folder and then navigate to the "submissions" directory. Each submission (.txt file) contains a link to the  actual write-up/video/code - open the link in a browser to view.<br>
<?php
//Get a list of file paths using the glob function.
$fileList = glob('../../participants/teams/*');
 
//Loop through the array that glob returned.
foreach($fileList as $filename){
   //Simply print them out onto the screen.
   $file = fopen($filename . "/teamname.txt","r");
    // echo fgets($file) . "<br>";

//    echo $filename, '<br>'; 
    $data = fgets($file);
    if (strlen($data)>0) {
      echo "<a href='".$filename."/uploader.php'><i class='fa fa-folder' aria-hidden='true'></i> ".$data."</a><br>";
    }
    fclose($file);

}

?>

</div>

</section>
<br>
    <script>
    $(function(){
      $("#footer").load("../../footer.html");
    });
    </script>
     <div id="footer"></div>
  </div>
<script src='../../js/accordian.js'></script>

</body>

</html>
