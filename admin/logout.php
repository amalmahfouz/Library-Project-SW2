<?php 

 include('../constant.php');
  //Destroy the session
  session_destroy();
  //rediret to login
  header("location:" . "login.php");

?>