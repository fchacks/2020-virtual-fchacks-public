<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="../style.css">
  <link rel="stylesheet" type="text/css" href="../css/slider.css">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../w3.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <title>My Account</title>
</head>

<body>
  <script>
    $(function() {
      $("#topbar").load("../topbar.php");
    });
  </script>
  <div id="topbar"></div><br>
  <div >
    <script>
      $(function() {
        $("#header").load("header.html");
      });
    </script>
    <div id="header"></div>

    <br>
    <section style="padding: 5px 5px 5px 15px;">

      <?php
      // Initialize the session
      session_start();

      // Check if the user is logged in, if not then redirect him to login page
      if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        if (!isset($_SESSION["admin"])) {
          header("location: login.php");
          exit;
        }
      }

      if ($_POST["lockTeams"]=="True" || $_POST["lockTeams"]=="False") {
        if ($_POST["lockTeams"] == "True") {
          exec("cp ./htacc teams/.htaccess");
          echo "<b style='color:red'>Locked</b>";
        } else {
          exec("rm teams/.htaccess");
          echo "<b style='color:red'>Unlocked</b>";

        }
      }

      ?>


      <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Virtual FCHacks.</h1>
      </div>

    </section><br>
    <section>
      <div class="text-body" style="font-size: 20px;">


        <p><b>
FCHacks username: <?php echo htmlspecialchars($_SESSION["username"]); ?><br><br></b>
          To begin competing, you will need a team (note: if you are already on a team, you will be redirected to your team):
          <br>
          <br>
          <a id="teamLink" class="btn btn-danger btn-lg" href="users/<?php echo htmlspecialchars($_SESSION["username"]); ?>/team.php" >Manage Team</a>
      
          <!--        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>-->
          <!-- <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a> -->
          <br>
          
          <pre>
<?php
echo file_get_contents("logindata/" . $_SESSION["username"] . ".data.txt"); // get the contents, and echo it out.
?>
</pre>

          <?php
          if (isset($_SESSION["admin"])) {
            echo "<br><br><a href='teams/'><img src='http://archive.ev3lessons.com/web/folder.gif'>View Teams</a><br><a href='users/'><img src='http://archive.ev3lessons.com/web/folder.gif'>View Users</a><br><a href='logindata/'><img src='http://archive.ev3lessons.com/web/folder.gif'>View User Data</a><br><br>
              
<form action='#' method='POST'>
<input type='hidden' name='lockTeams' value='True' >
<input type='submit' value='lock teams'>
</form>
";
echo "
<form action='#' method='POST'>
<input type='hidden' name='lockTeams' value='False'>
<input type='submit' value='unlock teams'>
</form>
              ";
          }
          ?>
        </p>
      </div>

    </section>
    <br>
    <script>
      $(function() {
        $("#footer").load("../footer.html");
      });
    </script>
    <div id="footer"></div>
  </div>
  <script src='../js/accordian.js'></script>

</body>

</html>
