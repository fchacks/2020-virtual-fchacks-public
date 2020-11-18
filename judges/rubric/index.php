<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["Jloggedin"]) || $_SESSION["Jloggedin"] !== true) {
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

  <title>Rubric</title>
</head>

<body>
  <script>
    $(function() {
      $("#topbar").load("../../topbar.php");
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

      <h2>Rubric Manager</h2>
    </section><br>
    <section>
      <div class="text-body" style="font-size: 20px;">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->


        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>

        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/core.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.js"></script>


        <!-- <meta http-equiv="refresh" content="10;">-->
        <script type="text/javascript" src="gs_sortable.js"></script>

        <script type="text/javascript">
          dir = window.location.hash.substring(1);

          function textFileToArray(filename) {
            var reader = (window.XMLHttpRequest != null) ?
              new XMLHttpRequest() :
              new ActiveXObject("Microsoft.XMLHTTP");
            reader.open("GET", filename, false);
            reader.send();
            return reader.responseText.split(/\r\n|\n|\r/); //split(/(\r\n|\n)/g) 
          }
          // col = parseInt(textFileToArray("rounds.txt")[0]) + 1;
          col = 1 + 1;
          // tsort = ['my_table', 's'];

          // f = 1;
          // while (f < col+1) {
          // 	   tsort.push('i');
          // 	   f++;
          // 	   }


          // 	   var TSort_Data = tsort;
          // 	   f = f-1;
          // 	   var TSort_Initial =  new Array (''+f-1+'D');
          // tsRegister();
          /*
          tsort = ['my_table', 's'];
          f = 1;
          while (f < col) {
              tsort.push('i');
              f++;
          }
            */

          //  var TSort_Data = tsort;
          //  f = 0;
          //  var TSort_Initial =  new Array (''+f+'D');
          //  tsRegister();



          teamlist = textFileToArray("../../participants/teams/teams.txt");

          function fileExists(file_url) {

            var http = new XMLHttpRequest();

            http.open('HEAD', file_url, false);
            http.send();

            return http.status != 404;

          }

          // function gentable(teamin) {
          //   // tourn = window.location.href.split('/')[5]
          //   team = teamin.split('|||')[0];
          //   // team = teamin.split(',')[0] + " - " + teamin.split(',')[1]
          //   document.write('<tr>');
          //   c = 1;
          //   document.write('  <td>' + team + '</td>');
          //   document.write('  <td>' + teamin.split("|||")[1] + '</td>');

          //   while (c < col) {
          //     if (fileExists("teams/" + CryptoJS.MD5(team) + ".txt") == true) {
          //       // console.log("../teams/" +fwteam+ "/robotScores/" +c+ ".txt")
          //       teamscore = "✓";
          //     } else {
          //       teamscore = "X";
          //     }
          //     //document.write(' <td id="'+fwteam+'-'+c+'"><a href="/scorer/index.html?tourn='+tourn+'&team='+fwteam+'&round='+c+'">'+String(teamscore)+'</a></td>');
          //     document.write(' <td id="' + team + '-' + c + '"><button style="background-color:lightblue;width:100%; height:60px; font-size:40px;" onclick="window.parent.location.href = \'rubric.php?tourn=&team=' + encodeURI(team) + '&round=' + c + '\'">' + String(teamscore) + '</button></td>');


          //     c++;
          //   }
          //   document.write('</tr>');
          // }


          function gentable(teamin) {
            tourn = window.location.href.split('/')[5]
            team = teamin.split('|||')[0] ;

            document.write('<tr>');
            c = 1;
            document.write('  <td>'+team+'</td>');
            // while (c < col) {
            document.write('  <td>' + teamin.split("|||")[1] + '</td>');

            if (fileExists("teams/" + CryptoJS.MD5(team+ " (J1)") + ".txt") == true) {
              // console.log("../teams/" +fwteam+ "/robotScores/" +c+ ".txt")
              teamscore = textFileToArray("teams/" + CryptoJS.MD5(team+ " (J1)") + "-s.txt")[0].split(';')[0];
                // teamscore = "X";
            } else {
                teamscore = "0";
            }

            if (fileExists("teams/" + CryptoJS.MD5(team+ " (J2)") + ".txt") == true) {
              // console.log("../teams/" +fwteam+ "/robotScores/" +c+ ".txt")
              teamscore2 = textFileToArray("teams/" + CryptoJS.MD5(team+ " (J2)") + "-s.txt")[0].split(';')[0];
                // teamscore = "X";
            } else {
                teamscore2 = "0";
            }

            if (fileExists("teams/" + CryptoJS.MD5(team+ " (J3)") + ".txt") == true) {
              // console.log("../teams/" +fwteam+ "/robotScores/" +c+ ".txt")
              teamscore3 = textFileToArray("teams/" + CryptoJS.MD5(team+ " (J3)") + "-s.txt")[0].split(';')[0];
                // teamscore = "X";
            } else {
                teamscore3 = "0";
            }

            if (fileExists("teams/" + CryptoJS.MD5(team+ " (J4)") + ".txt") == true) {
              // console.log("../teams/" +fwteam+ "/robotScores/" +c+ ".txt")
              teamscore4 = textFileToArray("teams/" + CryptoJS.MD5(team+ " (J4)") + "-s.txt")[0].split(';')[0];
                // teamscore = "X";
            } else {
                teamscore4 = "0";
            }
            //document.write(' <td id="'+fwteam+'-'+c+'"><a href="/scorer/index.html?tourn='+tourn+'&team='+fwteam+'&round='+c+'">'+String(teamscore)+'</a></td>');
            document.write(' <td id="'+team+'-1'+c+'">\
            <a val="'+String(teamscore)+'" href=\'rubric.php?tourn=&team=' + encodeURI(team+ " (J1)") + '&round=' + c + '\'>'+String(teamscore)+'</a>\
            </td>');

            document.write(' <td id="'+team+'-2'+c+'">\
            <a val="'+String(teamscore2)+'" href=\'rubric.php?tourn=&team=' + encodeURI(team + " (J2)") + '&round=' + c + '\'>'+String(teamscore2)+'</a>\
            </td>');
          
            document.write(' <td id="'+team+'-3'+c+'">\
            <a val="'+String(teamscore3)+'" href=\'rubric.php?tourn=&team=' + encodeURI(team + " (J3)") + '&round=' + c + '\'>'+String(teamscore3)+'</a>\
            </td>');

            document.write(' <td id="'+team+'-4'+c+'">\
            <a val="'+String(teamscore4)+'" href=\'rubric.php?tourn=&team=' + encodeURI(team + " (J4)") + '&round=' + c + '\'>'+String(teamscore4)+'</a>\
            </td>');
        // c++;
        //     }
            document.write('</tr>');
        }
        </script>

        <!--      <h1>EV3Lessons Tournament Scoring System -> Load Scorer -> v<script>
function textFileToArray(filename) {
    var reader = (window.XMLHttpRequest != null )
               ? new XMLHttpRequest()
               : new ActiveXObject("Microsoft.XMLHTTP");
    reader.open("GET", filename, false );
    reader.send();
    return reader.responseText.split(/\r\n|\n|\r/);  //split(/(\r\n|\n)/g)
}
document.write(textFileToArray('/version.txt')[0]);
      </script>

</h1>
    <br>-->
    Instructions: For each team, click on the button in the "Rubric" column to open the rubric. Then, complete the rubric and click save.<br><br>
        Key: Click on the number (score) under the rubric to open it for each team
        <br>
        <table style='width:100%;font-size:20px;border-collapse: collapse;' border="1" id="my_table">
          <thead>
            <tr style="background-color: #b0261c;">
              <td>
                <button onclick="sortTable(0)">Team Name</button>
              </td>
              <td>
                <button onclick="sortTable(1)">Competition</button>

              </td>
              <td><button onclick="sortTable(2)">Judge 1 Rubric</button></td>
              <td><button onclick="sortTable(3)">Judge 2 Rubric</button></td>
              <td><button onclick="sortTable(4)">Judge 3 Rubric</button></td>
              <td><button onclick="sortTable(5)">Judge 4 Rubric</button></td>

              <!--	   <td>High Score</td>-->
            </tr>
          </thead>
          <script>
            n = 0;
            while (n < teamlist.length - 1) {
              gentable(teamlist[n]);
              n++;
            }
          </script>
        </table>
        <script>
          //language = window.location.hash.substring(1);
          /*
             scores = textFileToArray("/"+dir+"/scores.txt");
          scores.sort();
          x = 1;
          lastteam = '';
          thisteam = '';
          lastpoints = 0;
          thispoints = 0;
          count = scores.length;
          while (x < count) {
          RoundId = scores[x].split(', ')[0].split(' ')[0] + scores[x].split(', ')[1];
          	   Points = scores[x].split(', ')[2].split(' ')[0];
          	   thisteam = scores[x].split(', ')[0].split(' ')[0];
          	   thispoints = parseInt(Points);
          if (thisteam == lastteam) {
          	   if (thispoints > lastpoints) {
          document.getElementById(scores[x].split(', ')[0].split(' ')[0] + String(col-1)).innerHTML = thispoints;
               }
               } else {
          document.getElementById(scores[x].split(', ')[0].split(' ')[0] + String(col-1)).innerHTML = thispoints;
               }
          	   lastteam =  scores[x].split(', ')[0].split(' ')[0];
          lastpoints = parseInt(scores[x].split(', ')[2].split(' ')[0]);
          	   x = x + 1;
          	   document.getElementById(RoundId).innerHTML = Points;
               }
          */
        </script>


      </div>

    </section>
    <br>
    <script>
      $(function() {
        $("#footer").load("../../footer.html");
      });
    </script>
    <div id="footer"></div>
  </div>
  <script src='../../js/accordian.js'></script>

  <script>
    function sortTable(n) {
      var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
      table = document.getElementById("my_table");
      switching = true;
      //Set the sorting direction to ascending:
      dir = "asc";
      /*Make a loop that will continue until
      no switching has been done:*/
      while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.getElementsByTagName("TR");
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
          //start by saying there should be no switching:
          shouldSwitch = false;
          /*Get the two elements you want to compare,
          one from current row and one from the next:*/
          x = rows[i].getElementsByTagName("TD")[n];
          y = rows[i + 1].getElementsByTagName("TD")[n];
          /*check if the two rows should switch place,
          based on the direction, asc or desc:*/
          if (dir == "asc") {
            if (n == 2) {
              if (parseInt(x.children[0].innerHTML) > parseInt(y.children[0].innerHTML)) {
                            //if so, mark as a switch and break the loop:
                              shouldSwitch = true;
               break;
              }
            } else {
              if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                //if so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
              }
            }
          } else if (dir == "desc") {
            if (n >= 2) {
              if (parseInt(x.children[0].innerHTML) < parseInt(y.children[0].innerHTML)) {
                shouldSwitch = true;
                break;
              }
            } else {
              if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                //if so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
              }
            }
          }
        }
        if (shouldSwitch) {
          /*If a switch has been marked, make the switch
          and mark that a switch has been done:*/
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
          //Each time a switch is done, increase this count by 1:
          switchcount++;
        } else {
          /*If no switching has been done AND the direction is "asc",
          set the direction to "desc" and run the while loop again.*/
          if (switchcount == 0 && dir == "asc") {
            dir = "desc";
            switching = true;
          }
        }
      }
    }
    sortTable(1)
  </script>

</body>