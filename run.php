<?php
include ('inc/config.php');
 $sig = mysqli_query($connect, "SELECT * FROM mid_term_results WHERE teacher =0");
 while ($s = mysqli_fetch_array($sig)) {
     $up = mysqli_query($connect, "UPDATE mid_term_results SET teacher = 13 WHERE teacher = 0");

 } ?>