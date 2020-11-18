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
            if (!isset($_SESSION["Jloggedin"]) || $_SESSION["Jloggedin"] !== true) {
                header("location: login.php");
                exit;
            }
            ?>
            <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["Jusername"]); ?></b>. Welcome to our site.</h1>

        </section><br>
        <section>
            <div class="text-body" style="font-size: 20px;">


                <p>
                    Instructions: For each team you have been assigned to judge, open their <a href="rubric/" class="btn btn-danger">Judging Rubric</a>.
                    
                    <br> 
                    <br>
                    
                    Prior to completing the rubric, read their submissions by viewing their <a href="teams/" class="btn btn-danger">Team Data</a>.
                    <br><br> Judge the team based on the submissions provided.
                    <br><br>

                    <!--        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>-->
                    <!-- <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a> -->
                </p>

<pre>
<?php
echo file_get_contents("logindata/".trim($_SESSION["Jusername"]).".data.txt"); // get the contents, and echo it out.
?>
</pre>

                <?php
        if (isset($_SESSION["admin"])) {
          echo "<br><br><a href='logindata/'><img src='http://archive.ev3lessons.com/web/folder.gif'>View User Data</a>";
        }
      ?>

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