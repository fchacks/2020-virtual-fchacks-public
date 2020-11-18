<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="css/slider.css">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="w3.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<title>Home</title>
</head>
<body>
   <script>
    $(function(){
      $("#topbar").load("topbar.php");
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

<h2><img src="virt-logo-red.png" width="100%">
</h2>
</section><br>
<section> <div class="text-body" style="font-size: 20px;">
<div class="container">
  <div class="row">
    <div class="col-sm">
      <a class="btn btn-danger btn-lg" href="participants/">Register to Compete</a>
    </div>
    <div class="col-sm">
      <a class="btn btn-danger btn-lg" href="judges/">Register to Judge</a>
    </div>
    <div class="col-sm">
      <a class="btn btn-secondary btn-lg" href="http://www.fchacks.org">FCHacks Homepage</a>
    </div>
  </div>
</div>


</div>

</section>
<br>
    <script>
    $(function(){
      $("#footer").load("footer.html");
    });
    </script>
     <div id="footer"></div>
  </div>
<script src='js/accordian.js'></script>

</body>

</html>
