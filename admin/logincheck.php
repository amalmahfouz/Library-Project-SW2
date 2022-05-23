
<?php 
//Authorization and access control
// checked user loged in or not
if(!isset($_SESSION['user'])){
    //user not login
    //redirect login page with masseage
    $_SESSION['no-login-message']="<div class='error'>Please Login To Access Admin Panel</div>";
    header("location:" . "login.php");

}
?>