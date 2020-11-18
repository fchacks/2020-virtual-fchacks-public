<?php
session_start();

 set_time_limit(0); # This program needs to run forever. 
 $filename = end(explode("/",$_SERVER[REQUEST_URI]));
//  while (true) {
        // echo $filename;
if (isset($_SESSION['Jloggedin'])) {
        readfile($filename);
} else {
        echo "permission denied\n";
}
// }
?>