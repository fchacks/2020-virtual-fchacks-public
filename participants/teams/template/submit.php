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
if (isset($_POST['writeup']))
{

  
    $file = fopen('uploads/submissions/writeup.txt', "w") or die("<br><b>Failed</b><br>");
    fwrite($file, $_POST["writeup"]);
    fclose($file);
    $file = fopen('uploads/submissions/video.txt', "w") or die("<br><b>Failed</b><br>");
    fwrite($file, $_POST["video"]);
    fclose($file);
    $file = fopen('uploads/submissions/code.txt', "w") or die("<br><b>Failed</b><br>");
    fwrite($file, $_POST["code"]);
    fclose($file);
  
    // redirect to form again
    //header(sprintf('Location: %s', $url));


    printf('<br><b style="color: red">Data have been saved</b><br>');
 

echo "";
}


if($_SESSION["username"] == $member1 || $_SESSION["username"] == $member2 || $_SESSION["username"] == $member3 || $_SESSION["username"] == $member4){} else {
  if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    header("location: ../../login.php");
    exit;
  }
}

$file = fopen("uploads/submissions/writeup.txt","rw");
// read the textfile 
$writeup = trim(fgets($file));
fclose($file);

$file = fopen("uploads/submissions/code.txt","rw");

$code = trim(fgets($file));
fclose($file);

$file = fopen("uploads/submissions/video.txt","rw");

$video = trim(fgets($file));
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

<title>Submit</title>
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

<h2>Submit Materials - <?php echo $teamname; ?>:</h2>
</section><br>
<section> <div class="text-body" style="font-size: 20px;">
<b>Competition:</b> <?php echo $category; ?><br><br>
<!-- HTML form -->


<form style="max-width:500px" action="" method="post">
      Link to Write-up: <input class="form-control" type="text" id="writeup" name="writeup" value="<?php echo htmlspecialchars($writeup); ?>">
      
      
      Link to Video: <input class="form-control" type="text" id="video" name="video" value="<?php echo htmlspecialchars($video); ?>">
     
      
      Link to Code: <input  class="form-control" type="text" id="code" name="code" value="<?php echo htmlspecialchars($code); ?>">
      <br>
      
      <input class="btn btn-danger btn-lg" id="teams" value="Save Links" type="submit"/>
      <input class="btn btn-danger btn-lg" type="reset" value="Cancel"/>
</form>

<br>
Remember you will need to submit the following:
<ul>
    <li>1-2 page write up of solution</li>
    <li>Video of working solution</li>
    <li>Full code</li>
</ul>
In your write-up, please list the names of all team members and the names of the schools that each attends.<br><br>
If you are having trouble submitting, you may email materials to <a href="mailto:team@fchacks.org">team@fchacks.org</a>.<br><br>

Remember that if you use Google drive, Dropbox, etc. to submit links, the files should be set to "anyone with the link can view". Github repositories for code must be set to public.

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
