<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    header("location: ../../login.php");
    exit;
  }
}

if ($_SESSION["username"] !== basename(dirname(__FILE__))) {
  if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<title>Team</title>
</head>
<body>
   <script>
    $(function(){
      $("#topbar").load("../../../topbar.php");
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

<h2>Manage Team:</h2>
</section><br>
<section> <div class="text-body" style="font-size: 20px;">


<?php
if(isset($_POST["submit"])) {
  $url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => 'XXX',
		'response' => $_POST["g-recaptcha-response"]
	);
	$options = array(
		'http' => array (
			'method' => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$verify = file_get_contents($url, false, $context);
	$captcha_success=json_decode($verify);

	if ($captcha_success->success==false) {
        // echo "<p style='color:red;'>Failed: You are a bot.</p>";
        echo "<b style='color:red'>Failed: You are a bot.</b><br>";
	} else if ($captcha_success->success==true) {
		// echo "<p>You are not not a bot!</p>";
    
    $teamname = md5($_POST["teamname"]);
    if (!file_exists("../../teams/" . $teamname)) {
      exec("cp -pr ../../teams/template ../../teams/" . $teamname);
      $user = fopen('../../teams/' . $teamname . '/members.txt', "w") or die("Unable to open file1!");
      fwrite($user, $_SESSION["username"]);
      fclose($user);
      $user = fopen('team.txt', "w") or die("Unable to open file1!");
      fwrite($user, $teamname);
      fclose($user);
      $user = fopen('../../teams/' . $teamname . '/teamname.txt', "w") or die("Unable to open file1!");
      fwrite($user, $_POST["teamname"] . "\n" . $_POST["category"]);
      fclose($user);
      $teams = '../../teams/teams.txt';
      $current = file_get_contents($teams);
      $current .= $_POST["teamname"] . "|||" . $_POST["category"] . "\n";
      file_put_contents($teams, $current);

      // exec("sudo mkdir -p ".getcwd()."/home/Desktop/");
      // exec("sudo ln -s /var/www/fchacks/participants/teams/".$teamname."/uploads ".getcwd()."/home/Desktop/myTeam");



      echo "team created<br>";
    } else {
      echo "<br><b style='color:red;'>Error: Team name already in use</b><br>";
    }
  }
}


?>

<?php
if (!file_exists("team.txt")) {
  echo '
  Here you can chose to create a team for the competition. You will be able to invite 3 others to join using their usernames. If you create a team, you cannot join another one (this is irreversible). To join a team, have a member of that team add you. Even if you are competing as an individual, you need to create a team.<br><br>
  <form style="max-width:500px" action="team.php" method="post" enctype="multipart/form-data">
    <b>Make a team:</b><br><br>
    Team name: <input class="form-control" type="text" name="teamname" id="teamname"><br>
    Competition: <select class="form-control" name="category" id="category">
    <option ></option>
    <option >Virtual FCHacks 2020</option>
  </select><br>
  <div class="g-recaptcha" data-sitekey="6Le8yK4ZAAAAAJkBLDKS-S1VkyWj3RG7vtLPm-PA"></div>
    <input class="btn btn-danger btn-lg" type="submit" value="Create" name="submit">
  </form>';
} else {
  $link = trim(fgets(fopen('team.txt', "r")));
  header("location: ../../teams/" . $link . "/");
}
?><br><br>
<b>Virtual FCHacks 2020</b>
<p>Develop a computer or mobile application in the programming language of your choice to solve a problem related to a topic. You may choose to use any hardware that you own as part of your project (e.g. microcontrollers). You will not be at a disadvantage in any way if you do not own hardware. We will provide resources for teams using Java, Python, Swift, Raspberry Pi, or Arduino, but any programming language and platform is permitted. The project will be judged based on completeness and features of the code/hardware (if applicable) along with the innovation/feasibility of the solution.</p>

</p>


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
