<?php
/* this script destroys the current session
(i.e. logs out the user)
*/
session_start();
session_destroy();
header("location:../index.php");
?>