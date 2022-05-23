
<?php include('../constant.php'); ?>

<html>
<head>
    <title>Login - Admin</title>
    <link rel="stylesheet" href="../admin.css">
</head>

<body class="loginback">
    <div class="login">
        <h1 class="text-center">Login</h1>



        <?php
       
        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }

        if (isset($_SESSION['login'])) {
          echo $_SESSION['login'];
          unset($_SESSION['login']);
      }

          if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        
        ?>
        <br>

        <!--login form start-->
        <form action="" method="POST">

            <label >Username</label> &nbsp;
              <input type="text" name="username" placeholder="Enter Username" required > <br><br>

            <label >Password</label> &nbsp;&nbsp;              
              <input type="password" name="password" placeholder="Enter Password" minlength="8" required ><br><br>&nbsp;
              
            <label> <a href="register.php">Create a new account ?</a></label>

            <br> <br>
            <button type="submit" name="submit" value="Login" class="btn-brimary1"  >Login</button>
        </form>
            <!--login form end-->
     </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn, (md5($_POST['password'])));



    $sql = "SELECT * FROM  tbl_admin WHERE username='$username' AND password='$password'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
               $rows = mysqli_fetch_assoc($res);
               $id = $rows['id'];
        

        $_SESSION['login'] = "<div class='success'>Login Successfully ! ..</div>";
        $_SESSION['user'] = $username;
        $_SESSION['user_id'] = $id;

        //Redirect page 
        header("location:" . "dashboard.php");
    } else {
        $_SESSION['login'] = "<div class='error'>username or password not match !</div>";
        //Redirect page 
        header("location:" . "login.php");
    }

}
?>