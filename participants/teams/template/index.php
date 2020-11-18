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


printf('<br><b style="color: red">Members have been saved</b><br>');
 

echo "";
}


if($_SESSION["username"] == $member1 || $_SESSION["username"] == $member2 || $_SESSION["username"] == $member3 || $_SESSION["username"] == $member4){} else {
  if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    header("location: ../../login.php");
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

<title>Team Dashboard</title>
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

<h2>Team Dashboard - <?php echo $teamname; ?>:</h2>
</section><br>
<section> <div class="text-body" style="font-size: 20px;">
<b>Competition:</b> <?php echo $category; ?><br><br>
<!-- HTML form -->

<b>Step 1: Add team members</b><br>
<a class="btn btn-danger btn-lg" href="members.php">Manage Members</a>
<br><br>

<b>Step 2: Read the challenge</b>
<br>
<a class="btn btn-danger btn-lg" href="../../../challenge.html">The Challenge</a>
<br><br>

<b>Step 3: Program</b>
<br>
You may use any editor or language you want to program with your team. If you cannot install software on your computer (e.g. school issued), we reccomend that you use GitHub's online code editor.<br>
<br>
<br>
<!-- Link to terminal: <a href="/shell">Linux Shell (coming soon)</a><br> -->
<b>Step 4: When you are finished, you will need to submit your materials</b><br>
<a class="btn btn-danger btn-lg" href="submit.php">Submit materials</a><br>
<br>
<br>
<b>Here are some tips for collaborating on code:</b><br>
For code sharing, you can take a look at <a href="https://code.visualstudio.com/">VS Code</a>, <a href="https://www.digitalocean.com/community/tutorials/how-to-use-live-share-with-visual-studio-code">VS Code live sharing</a>, and <a href="https://repl.it/">Rep.it</a>. We also recommend that you use <a href="https://www.github.com">GitHub</a> to manage code changes. For more resources, please take a look at the Resources section of the <a href="https://docs.google.com/document/d/1nIxGksTA_Yy1PwA6PW52BNwZH5gxwHNrhXQDvnLdz9o/edit">handbook</a>.<br><br>

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
