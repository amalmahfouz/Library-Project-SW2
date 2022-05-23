
<?php include('../constant.php'); ?>
<html>
<head>
    
    <title>Register - Admin</title>
    <link rel="stylesheet" href="../admin.css">
</head>

<body class="registerback">
    <div class="register">
        <h1 class="text-center">Sign Up</h1>
        <br>

         <?php


        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        
        ?> 
        <br>

        <!--login form start-->
        <form action="" method="POST">
            <label >Username</label> &nbsp;
              <input type="text" name="username" placeholder="Enter Username" required > <br><br><br>

              <label >Email</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="email" name="email" placeholder="Enter Email" required > <br><br><br>

              <label >Password</label> &nbsp;&nbsp;
              <input type="password" name="password" placeholder="Enter Password" minlength="8" required ><br> 


            <br> <br>
            <button type="submit" name="submit" value="signup" class="btn-brimary1"  >Sign Up</button>
            <br> <br> <br> <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a  href="login.php" style="text-decoration: none;color:#fff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Back &nbsp;>> </a><br><br>
        </form>
            <!--login form end-->
     </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,md5($_POST['password']));//password encripting
   

    $sql = "INSERT INTO  tbl_admin SET    
    username='$username',
    email  = '$email', 
    password = '$password'
";
    //execute query ans save data in db
    $res = mysqli_query($conn, $sql);

    //check if data insert or not, display message
    if($res == true){
        //create a session variable to display message
        $_SESSION['add']= "<div class='success'>Register Successfully, can login with password! ..</div>";

                            header("location:" . "login.php");
    }
    else{
        $_SESSION['add']="<div class='error'> Email not allowed !</div>";

        header("location:" . "register.php");
    }
}


?>