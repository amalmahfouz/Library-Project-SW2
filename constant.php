<?php
session_start();
$conn = mysqli_connect('localhost','root','');
$db_select =mysqli_select_db($conn,'library');
?>