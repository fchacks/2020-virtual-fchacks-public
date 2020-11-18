<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  if(!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true){
    header("location: ../../login.php");
    exit;
  }
}
if ($_SESSION["username"] !== basename(dirname(__FILE__))) {
  if(!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true){

    header("location: ../../welcome.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../../style.css">
<link rel="stylesheet" type="text/css" href="../../../css/slider.css">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="../../../w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 
<title>Home</title>
</head>
<body>
   <script>
    $(function(){
      $("#topbar").load("../../../topbar.php");
    });
    </script>
    <div id="topbar"></div><br>
  <div style="max-width: 1024px;margin:0 auto;">
    <script> 
    $(function(){
      $("#header").load("header.html"); 
    });
    </script>
     <div id="header"></div>

<br>
<section style="padding: 5px 5px 5px 15px;">

<h2>Welcome User <?php echo htmlspecialchars($_SESSION["username"]); ?> :</h2>
</section><br>
<section> <div class="text-body" style="font-size: 20px;">

Thank you for competing in FCHacks.

<br>

<br>
The first step is to join or start a team:
<br>
<a href="team.php">Manage team</a>

</div>

</section>
<br>
    <script>
    $(function(){
      $("#footer").load("../../../footer.html");
    });
    </script>
     <div id="footer"></div>
  </div>
<script src='../../../js/accordian.js'></script>

</body>

</html>
