<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    header("location: ../../login.php");
    exit;
  }
}
// configuration
//$url = 'setup.php';
$file = fopen("teamname.txt","r");
$teamname = trim(fgets($file));
$category = trim(fgets($file));
fclose($file);

$file = fopen("members.txt","rw");
// read the textfile
$member1 = trim(fgets($file));
$member2 = trim(fgets($file));
$member3 = trim(fgets($file));
$member4 = trim(fgets($file));
fclose($file);


// check if form has been submitted
if (isset($_POST['member1']))
{

    if(file_exists('../../users/'. $_POST['member1'] . '/team.txt') && $_POST['member1'] !== $member1){
        die("<br><b>User ". $_POST['member1'] ." is already in a team!</b><br>");
    }
    if(file_exists('../../users/'. $_POST['member2'] . '/team.txt') && $_POST['member2'] !== $member2){
        die("<br><b>User ". $_POST['member2'] ." is already in a team!</b><br>");
    }
    if(file_exists('../../users/'. $_POST['member3'] . '/team.txt')&& $_POST['member3'] !== $member3){
        die("<br><b>User ". $_POST['member3'] ." is already in a team!</b><br>");
    }
    if(file_exists('../../users/'. $_POST['member4'] . '/team.txt')&& $_POST['member4'] !== $member4){
        die("<br><b>User ". $_POST['member4'] ." is already in a team!</b><br>");
    }



    $user = fopen('../../users/'. $_POST['member1'] . '/team.txt', "w") or die("<br><b>User ". $_POST['member1'] ." does not exist!</b><br>");
    fwrite($user, md5($teamname));
    fclose($user);
    $user = fopen('../../users/'. $_POST['member2'] . '/team.txt', "w") or die("<br><b>User ". $_POST['member2'] ." does not exist!</b><br>");
    fwrite($user, md5($teamname));
    fclose($user);
    $user = fopen('../../users/'. $_POST['member3'] . '/team.txt', "w") or die("<br><b>User ". $_POST['member3'] ." does not exist!</b><br>");
    fwrite($user, md5($teamname));
    fclose($user);
    $user = fopen('../../users/'. $_POST['member4'] . '/team.txt', "w") or die("<br><b>User ". $_POST['member4'] ." does not exist!</b><br>");
    fwrite($user, md5($teamname));
    fclose($user);
    // redirect to form again
    //header(sprintf('Location: %s', $url));

    $wfile = "members.txt";
    // save the text contents
    $wfile = str_replace("\r", "", $wfile);
    
    file_put_contents($wfile, $_POST['member1'] . "\n");
    file_put_contents($wfile, $_POST['member2'] . "\n", FILE_APPEND | LOCK_EX);
    file_put_contents($wfile, $_POST['member3'] . "\n", FILE_APPEND | LOCK_EX);
    file_put_contents($wfile, $_POST['member4'] . "\n", FILE_APPEND | LOCK_EX);

    // exec("sudo mkdir -p /var/www/fchacks/participants/users/".$_POST['member1']."/home/Desktop/");
    // exec("sudo ln -s ".getcwd()."/uploads /var/www/fchacks/participants/users/".$_POST['member1']."/home/Desktop/myTeam");

printf('<br><b style="color: red">Members have been saved</b><br>');
 

echo "";
}


if($_SESSION["username"] == $member1 || $_SESSION["username"] == $member2 || $_SESSION["username"] == $member3 || $_SESSION["username"] == $member4){} else {
  if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    header("location: ../../login.php");
    exit;
  }
}

$file = fopen("members.txt","rw");
// read the textfile
$member1 = trim(fgets($file));
$member2 = trim(fgets($file));
$member3 = trim(fgets($file));
$member4 = trim(fgets($file));
fclose($file);


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

<title>Team Members</title>
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

<h2>Team Members - <?php echo $teamname; ?>:</h2>
</section><br>
<section> <div class="text-body" style="font-size: 20px;">
<b>Competition:</b> <?php echo $category; ?><br><br>
<!-- HTML form -->

<b>List of team members</b><br>
You may list up to 4 team members here. Enter the username of each user. Each member needs a FCHacks user account prior to being added to the team.
<br>
<form style="max-width:500px" action="" method="post">
      Member 1: <input class="form-control" <?php if (strlen($member1)>1) {echo "readonly";}  ?> type="text" id="member1" name="member1" value="<?php echo htmlspecialchars($member1); ?>">
      
      <?php
        if (isset($_SESSION["admin"])) {
          echo "<a href='../../logindata/".htmlspecialchars($member1).".data.txt'><img src='http://archive.ev3lessons.com/web/folder.gif'></a>";
        }
      ?>
      
      <br>
      Member 2: <input class="form-control" <?php if (strlen($member2)>1) {echo "readonly";}  ?>  type="text" id="member2" name="member2" value="<?php echo htmlspecialchars($member2); ?>">
      <?php
        if (isset($_SESSION["admin"])) {
          echo "<a href='../../logindata/".htmlspecialchars($member2).".data.txt'><img src='http://archive.ev3lessons.com/web/folder.gif'></a>";
        }
      ?>
      <br>
      Member 3: <input class="form-control" <?php if (strlen($member3)>1) {echo "readonly";}  ?>  type="text" id="member3" name="member3" value="<?php echo htmlspecialchars($member3); ?>">
      
      <?php
        if (isset($_SESSION["admin"])) {
          echo "<a href='../../logindata/".htmlspecialchars($member3).".data.txt'><img src='http://archive.ev3lessons.com/web/folder.gif'></a>";
        }
      ?>

      <br>
      Member 4: <input class="form-control" <?php if (strlen($member4)>1) {echo "readonly";}  ?>  type="text" id="member4" name="member4" value="<?php echo htmlspecialchars($member4); ?>">
      <?php
        if (isset($_SESSION["admin"])) {
          echo "<a href='../../logindata/".htmlspecialchars($member4).".data.txt'><img src='http://archive.ev3lessons.com/web/folder.gif'></a>";
        }
      ?>
      
      <br>
      <br>
      <input class="btn btn-danger btn-lg" id="teams" value="Save Members" type="submit"/>
      <input class="btn btn-danger btn-lg" type="reset" value="Cancel"/>
</form>

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
