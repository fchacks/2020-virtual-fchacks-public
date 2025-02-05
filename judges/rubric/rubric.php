<?php
// Initialize the session
session_start();
 
if(!isset($_SESSION["Jloggedin"]) || $_SESSION["Jloggedin"] !== true ){
    header("location: ../login.php");
    exit;
}
?>

<?php
if (isset($_POST['teamNo']))
{
  // echo $_POST['teamNo'] . "<br>";
  // echo $_POST['roundNo'] . "<br>";
  // echo $_POST['store'] . "<br>";

  $filename = "teams/" . md5($_POST['teamNo']) . ".txt";
    
  $user = fopen($filename, "w") or die("Failed to save. Please try again.");
  fwrite($user, $_POST['store']);
  fclose($user);
  
  $filename = "teams/" . md5($_POST['teamNo']) . "-s.txt";
    
  $user = fopen($filename, "w") or die("Failed to save. Please try again.");
  fwrite($user, $_POST['score']);
  fclose($user);
  
  echo "<b style='color: red'>Saved</b><script>alert('Saved')</script>";
}
?>




<!DOCTYPE html>
<html>

<head>

    <title>Rubrics</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="color-scheme" content="light dark" />

    <script src="assets/js/jquery-1.11.3.min.js"></script>


    <script>
        $(document).bind('mobileinit', function() {
            $.mobile.changePage.defaults.changeHash = false;
            $.mobile.hashListeningEnabled = false;
            $.mobile.pushStateEnabled = false;
        });

        language = "en"
    </script>
    <!-- <script src="assets/js/highcharts.js"></script>
  <script src="assets/js/exporting.js"></script> -->
    <!-- <script src="assets/js/scorer.js"></script> -->
    <script src="assets/js/timers.js"></script>
    <script src="assets/js/rubricSaver.js"></script>
    <script src="assets/js/html.js"></script>
    <script src="assets/js/jquery.mobile-1.4.5.min.js"></script>

    <script type="text/javascript" src="assets/js/jqm-spinbox.min.js"></script>





    <link rel="stylesheet" href="assets/css/jquery.mobile-1.4.5.min.css">
    <!--    <link rel="stylesheet" href="assets/css/tournament.css"> -->
    <link rel="stylesheet" href="assets/css/jquery.mobile.icons.min.css" />
    <!-- <link rel="stylesheet" href="assets/css/scorer.min.css" /> -->

    <style>
        .no-mobile {
            display: inline;
        }
        
        .only-mobile {
            /* display: none; */
        }
        
        .highcharts-button {
            display: none;
        }
        
        .only-print,
        .only-print * {
            display: none !important;
        }
        
        @media print {
            .no-print,
            .no-print * {
                display: none !important;
            }
            .only-print,
            .only-print * {
                display: block !important;
            }
            body {
                width: 800px;
                height: 100%;
            }
        }
        
        @page {
            size: A4 portrait;
            margin: 0.5cm;
        }
        
        a:link img {
            opacity: 1.0;
            filter: alpha(opacity=100);
            /* For IE8 and earlier */
            filter: alpha(opacity=60);
            /* For IE8 and earlier */
            transition: opacity .5s ease-in-out;
            -moz-transition: opacity .5s ease-in-out;
            -webkit-transition: opacity .5s ease-in-out;
        }
        
        a:hover img {
            opacity: 0.6;
            filter: alpha(opacity=60);
            /* For IE8 and earlier */
            transition: opacity .5s ease-in-out;
            -moz-transition: opacity .5s ease-in-out;
            -webkit-transition: opacity .5s ease-in-out;
        }
        
        table tr td {
            padding-left: 0px;
            padding-right: 0px;
            border-collapse: collapse;
            /* border: 1px solid black; */
            margin: 5px;
        }
        
        .rbtd {
            border: 1px solid black !important;
        }
        
        @media(max-width: 1067px) {
            .rbtd {
                /* width: 50%; */
                font-size: 80% !important;
            }
            label {
                font-size: 80% !important;
            }
        }
        
        @media(max-width: 605px) {
            .rbtd {
                /* width: 50%; */
                font-size: 60% !important;
            }
            label {
                font-size: 60% !important;
            }
        }
        
        @media(max-width: 413px) {
            .rbtd {
                /* width: 50%; */
                font-size: 50% !important;
            }
            label {
                font-size: 50% !important;
            }
        }
        /* #missionlist {
      width: auto;
      -webkit-column-width: 325px;
      -moz-column-width: 325px;
      column-width: 325px;
      -webkit-column-count: 3;
      -moz-column-count: 3;
      column-count: 3;
      -webkit-column-gap: 0;
      -moz-column-gap: 0;
      column-gap: 0;

    } */
        
        .missionFmt {
            padding-right: 3;
            padding-left: 0;
            -webkit-column-break-inside: avoid;
            page-break-inside: avoid;
            break-inside: avoid;
        }
        
        table {
            border-collapse: separate;
            border: solid black 1px;
            border-radius: 6px;
            -moz-border-radius: 6px;
        }
        
        td,
        th {
            /* border-left:solid black 1px; */
            /* border-top:solid black 1px; */
        }
        
        td {
            /* background-color: blue; */
            border-top: none !important;
        }
        
        td:first-child,
        td:first-child {
            border-left: none;
        }
    </style>
    <script src="assets/languages.js"></script>

    <script src="assets/js/language-detector.js">
    </script>


    <link rel="manifest" href="manifest.webmanifest">
    <meta name="theme-color" content="#1976d2">

    
  <script>
  function tournamentload() {
      round = getParameterByName('round');
        team = getParameterByName('team');
        tourn = getParameterByName('tourn');
        filename = team +'-'+round+'.txt'
        try {
          <?php 
          echo "loadRBsave(textFileToArray('teams/";
          echo md5(urldecode($_GET["team"]));
          echo ".txt')[0])"; 
          ?>
}
catch(err) {
console.log("failed to load; file does not exist")
}

  }
  </script>
</head>



<body id="wholeBody">

    <!-- start drawplan-->



    <!--end drawplan-->


    <img src="assets/images/ajax-loader.gif" id="loadingGif" style="background-color:white; width:100px; height: auto;position:fixed;left:50%;top:50%;margin-left: -50px;margin-top:-50px;z-index:10000000000000000000000000000000000000000;">

    <div id="contentload" style="display: none;">
        <div class="no-print"><br><br></div>
        <table class="no-print" style="width:98%; text-align:center; margin-left:auto; margin-right:auto;border:none!important;">
            <tr>
                <td style="width:25%; text-align:left">
                    <script>
                        var page = '';
                        //              var page = window.location.href.split("?")[0].split("#")[0] + '?lang=';
                        var i;
                        for (i = 0; i < langs.length; i++) {
                            window[langs[i].split(':')[0].split('-')[0]] = page + langs[i].split(':')[0];
                        }
                        var i;
                        for (i = 0; i < langs.length; i++) {
                            document.write('\
              <a class="no-print no-mobile" data-ajax="false" href="" onclick="createCookie(\'' + langs[i].split(":")[0] + '\');language=\'' + window[langs[i].split(":")[0].split("-")[0]] + '\';initpage();" style=" text-decoration: none">\
              <img src="assets/images/icons/countries/small/' + langs[i].split(":")[1] + '.png" alt="' + langs[i].split(":")[2] + '" title="' + langs[i].split(":")[2] + '" width="26" height="26" border="0">\
              </a>\
              ')
                        }
                    </script>

                </td>

                <script>
                    function getParameterByName(name, url) {
                        if (!url) url = window.location.href;
                        name = name.replace(/[\[\]]/g, "\\$&");
                        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                            results = regex.exec(url);
                        if (!results) return null;
                        if (!results[2]) return '';
                        return decodeURIComponent(results[2].replace(/\+/g, " "));
                    }

                    if (getParameterByName('team') != null) {
                        // document.getElementById('team_num').value = getParameterByName('team')
                    }
                </script>

                <td style="width:50%; font-size:24px; text-align:center">
                    <b class="no-print" id="title">Judging Rubrics (2020)</b>
                </td>
                <td style="width:25%; font-size:12px; text-align:right">
                    <img class="only-mobile" alt="FCHacks" style="border:0px solid #021a40;" src="../../../virt-logo-red.png" width="139">
                </td>
            </tr>
        </table>

        <script>
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

  if (getParameterByName('team') != null) {
  document.write('<b style="font-size: 150%; text-align:right;">Team: '+getParameterByName('team')+'</b>')
  //document.write('<br>Tournament ID#: '+getParameterByName('tourn'))
  }
  </script>


        <!-- <div role="main" class="ui-content" style="padding-right:0; padding-left:0"> -->
        <div data-role="tabs">


            <div id="tabs-1">
                <form>

                    <div id="projectlist" style="max-width: 1024px;">
                        <script src="assets/project.js"></script>

                    </div>
                    <button onclick="setTimeout(function()
          {
            rubricCalc()
      
          }, 100);" style="max-width: 500px" type="reset">Reset</button>
                </form>
            </div>
            <br><br>
            <div id="tabs-4">


            <div style="max-width:500px">
<iframe style="display: none;" id="saveframe"></iframe>

<button onclick="savetoserver();" id="saverTscorer" type="button" >Save</button>
<input onclick="window.location.href = 'index.php';" type="button" value="Return to Rubrics Manager">
</div>
<form action="" id="serverForm" method="post">
  <input type="hidden" id="roundNo" name="roundNo">
  <input type="hidden" id="teamNo" name="teamNo">
  <input type="hidden" id="store" name="store">
  <input type="hidden" id="score" name="score">

</form>
<script>
    round = getParameterByName('round');
      team = getParameterByName('team');
      tourn = getParameterByName('tourn');

  function savetoserver() {
    // points = parseInt(document.getElementById('allpoints').innerHTML)
    // getvar() //var store
    round = getParameterByName('round');
      team = getParameterByName('team');
      tourn = getParameterByName('tourn');

      document.getElementById("roundNo").value = 0
      document.getElementById("teamNo").value = team
      document.getElementById("score").value = document.getElementById("projpts").innerHTML

      // filename = team +'-'+round+'.txt'
      savedata = getRBSave().join("///");

      document.getElementById("store").value = savedata

      // document.getElementById('saveframe').src = encodeURI('/'+tourn+'/save.php?fname=' + filename+'&data='+savedata);
    // alert('Saved Score '+points+' points')
    document.getElementById("serverForm").submit()
  }
function textFileToArray(filename)
{
    var reader = (window.XMLHttpRequest != null )
               ? new XMLHttpRequest()
               : new ActiveXObject("Microsoft.XMLHTTP");
    reader.open("GET", filename, false );
    reader.send();
    return reader.responseText.split('\n'); //.split(/(\r\n|\n)/g);
}


</script>
  



            </div>




        </div>

        <noscript>Please enable JavaScript to continue using this application.</noscript>
        <div style="padding-left: 10px; " class="no-print">

            <!--  <text id="tournamentText">Tournament</text><br><br>-->

            <text id="revisionText">Rubrics v0.0.2 </text> <text id="versionText"></text>
            <!-- Built from FLLTutorials.com Rubrics v1.1.0 and EV3Lessons.com Scorer v3.6.0; Code Copyright Sanjay Seshan 2020-->
            <br>
            <br><text id="copyrightText">Copyright (c) 2020 fchacks.org</text><br>
            <br>
            <text id="translatorCredit"></text>
        </div>
        <br>
        <br>
        <br>
    </div>

</body>

<script>
    window.onload = function() {
        initpage();
        // displaysaves();
        // drawBasic();
        // loadsave(blanksave);
        // check_missions();
        // check_missions('piperemoval');
        // recalc(0,'piperemoval',0);

        var fileInputRB = document.getElementById('fileInputRB');

        fileInputRB.addEventListener('change', function(e) {
            var file = fileInput.files[0];
            var textType = /text.*/;

            var reader = new FileReader();

            reader.onload = function(e) {
                data = reader.result;
                //alert(data)

                window.localStorage.DRRBSscorer = data;
                maximumRB = window.localStorage.DRRBSscorer.split('&&&').length - 1
            }

            reader.readAsText(file);

        });

    }
</script>

<script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-65893558-1', 'auto');
    ga('send', 'pageview');
</script>

<div style="display:none" class="no-mobile">

    <a target="_blank" class="no-print" href="https://play.google.com/store/apps/details?id=com.ev3lessons.fllcityshaperscorer">
        <img id="googleplay" height="100" src="assets/google-play/en_get.svg"></a><br>

    <a target="_blank" class="no-print" href="https://apps.apple.com/app/fll-city-shaper-scorer/id1473760751?ls=1">
        <img id="appstore" height="68" style="padding: 15px" src="assets/app-store/en.svg"></a>


</div>

<style>
    @media (prefers-color-scheme: dark) {
        .timer {
            border: 10px solid #121212;
            border-collapse: collapse;
        }
        .ui-radio-off {
            background-color: #121212 !important;
            color: white !important;
            text-shadow: none !important;
        }
        .ui-btn {
            background-color: #121212 !important;
            color: white !important;
            text-shadow: none !important;
        }
        .ui-btn-active {
            background-color: green !important;
            color: white !important;
            text-shadow: none !important;
        }
        .ui-radio-on {
            background-color: green !important;
            color: white !important;
            text-shadow: none !important;
        }
        #timerChild {
            border: 10px solid white !important;
        }
        #stopwatchChild {
            border: 10px solid white !important;
        }
        #contentload {
            background-color: #121212 !important;
            color: white;
            text-shadow: none;
        }
        #wholeBody {
            background-color: #121212 !important;
        }
        .ui-popup {
            background-color: #121212 !important;
        }
        Table {
            border: 1px solid white !important;
        }
        Text {
            color: white !important;
            fill: white !important;
            text-shadow: none;
        }
        .timer {
            border: 10px solid white !important;
        }
        .ui-page {
            background-color: #121212 !important;
        }
        #loadingGif {
            background-color: #121212 !important;
        }
    }
    
    .timer {
        border: 10px solid black;
    }
    
    .ui-mobile .ui-page-active {
        display: block;
        overflow: visible;
        overflow-x: visible !important;
    }
    
    * {
        text-shadow: none;
    }
    /* .ui-shadow-inset {
    display: none !important;
  } */
</style>
<script>
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)');

    toggleDarkTheme(prefersDark.matches);

    // Listen for changes to the prefers-color-scheme media query
    prefersDark.addListener((mediaQuery) => toggleDarkTheme(mediaQuery.matches));

    // Add or remove the "dark" class based on if the media query matches
    function toggleDarkTheme(shouldAdd) {
        document.body.classList.toggle('dark', shouldAdd);
    }
</script>
<script>
    function checkDarkTheme() {
        return false
    }

    function initpage() {
        languageInit()
        checkDarkTheme()

        // if (window.localStorage.DRRBGoogleSheet != undefined) {
        //     document.getElementById('sheetId').value = window.localStorage.DRRBGoogleSheet;
        //     } else {
        // 	document.getElementById('sheetId').value = undefinedText;
        //     }


        // if (language == 'he' || language == 'ar') {
        //   document.getElementById("wholeBody").style.textAlign = "right"
        // } else {
        //   document.getElementById("wholeBody").style.textAlign = "left"

        // }

        // countrycode = language.split('-')[0]
        // if (language == 'he') {
        //   countrycode = "iw"
        // }

        // document.getElementById("appstore").src = "assets/app-store/" + language + ".svg"
        // document.getElementById("googleplay").src = "assets/google-play/" + countrycode + "_get.svg"

        // document.getElementById('title').innerHTML = title
        // document.getElementById('resetTxt').value = resetText
        // $('#resetTxt').button('refresh');

        // document.getElementById('pointsTxt').innerHTML = pointsText
        // document.getElementById('pointsTxt2').innerHTML = pointsText + ": "

        // // document.getElementById('saveGoogleBtn').innerHTML = savescoreText
        // // document.getElementById('loadTextGoogle').innerHTML = loadsaveText

        // document.getElementById('scorerTitle').innerHTML = scorerText
        // document.getElementById('savesTitle').innerHTML = savesText

        // // document.getElementById('signin-Google').innerHTML = signin
        // // document.getElementById('signout-Google').innerHTML = signout
        // // document.getElementById('GoogleCreate').innerHTML = GoogleCreate
        // // document.getElementById('GoogleOpen').innerHTML = GoogleOpen
        // // document.getElementById('googleText').innerHTML = googleSaveText
        // // document.getElementById('localText').innerHTML = localSaveText

        // // document.getElementById('isIE').innerHTML = isIE
        // // document.getElementById('googleIntro').innerHTML = googleIntro
        // // document.getElementById('pastSaves').innerHTML = pastSaves
        // // document.getElementById('instructions').innerHTML = instructions
        // // document.getElementById('instructionsA').innerHTML = instructionsA
        // // document.getElementById('instructionsB').innerHTML = instructionsB
        // // document.getElementById('instructionsC').innerHTML = instructionsC
        // // document.getElementById('instructionsD').innerHTML = instructionsD
        // // document.getElementById('instructionsE').innerHTML = instructionsE
        // // document.getElementById('instructionsF').innerHTML = instructionsF
        // // document.getElementById('instructionsG').innerHTML = instructionsG

        // // document.getElementById('teamText').innerHTML = teamText
        // // document.getElementById('roundText').innerHTML = roundText

        // document.getElementById('revisionText').innerHTML = revisionText
        // document.getElementById('copyrightText').innerHTML = copyrightText

        // // document.getElementById('systemText').innerHTML = systemText

        // // document.getElementById('idText').innerHTML = idText

        // document.getElementById('versionText').innerHTML = versionText

        // //	document.getElementById('tournamentText').innerHTML = tournamentText

        // if (translatorCredit != "") {
        //   document.getElementById('translatorCredit').innerHTML = translatorCredit
        // } else {
        //   document.getElementById('translatorCredit').innerHTML = "If you would like to help us translate this scorer into another language, please download <a rel='external' data-ajax='false' href='assets/CityShaper-translations-latest.rtf'>this file</a> and follow the instructions."
        // }

        // //   if ((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) {
        // // document.getElementById('notIE').style.display = 'none'
        // //   } else {
        // // document.getElementById('isIE').style.display = 'none'
        // //   }




        // var variables = ""
        // for (var name in this) {
        //   if (name[0] == "M" && name != "API_KEY") {
        //     variables += name + "\n";
        //     console.log(name)
        //     document.getElementById(name).innerHTML = window[name]
        //   }

        //   if (name.indexOf("yesText") != -1) {
        //     variables += name + "\n";
        //     console.log(name)
        //     document.getElementById(name).innerHTML = yes
        //   }

        //   if (name.indexOf("noText") != -1) {
        //     variables += name + "\n";
        //     console.log(name)
        //     document.getElementById(name).innerHTML = no
        //   }

        //   if (name.indexOf("partlyText") != -1) {
        //     variables += name + "\n";
        //     console.log(name)
        //     document.getElementById(name).innerHTML = partly
        //   }

        //   if (name.indexOf("completelyText") != -1) {
        //     variables += name + "\n";
        //     console.log(name)
        //     document.getElementById(name).innerHTML = completely
        //   }

        //   if (name.indexOf("mNum") != -1) {
        //     variables += name + "\n";
        //     console.log(name)
        //     document.getElementById(name).innerHTML = missionNumbering
        //   }
        // }

        // i = 0
        // while (i < document.getElementsByTagName("select").length) {
        //   var myselect = $("select#"+document.getElementsByTagName("select")[i].id);
        //   myselect[0].selectedIndex =myselect[0].selectedIndex;
        //   myselect.selectmenu("refresh");
        //   i=i+1
        // }

        // displaysaves()
        // drawBasic()
        try {
            tournamentload()
        } catch {}
        
        document.getElementById('contentload').style.display = 'block'
        document.getElementById('loadingGif').style.display = 'none'

      
        rubricCalc()

        checkDarkTheme()

    }

    initpage();



    // Query for the toggle that is used to change between themes

    // Listen for the toggle check/uncheck to toggle the dark class on the <body>

    // Listen for changes to the prefers-color-scheme media query



    // Called by the media query to check/uncheck the toggle
</script>

</html>