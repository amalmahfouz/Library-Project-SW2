<?php
include('../constant.php'); 
include('logincheck.php');
?>

<!DOCTYPE html>
<html  >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Library</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../admin.css">

     <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
     <!-- font awesome cdn link  @ https://cdnjs.com/ The iconic SVG, font, and CSS toolkit  -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

</head>

<body>

<div class="container">
        <div class="navigation">
        <ul>
            <li>
                <a href="#">
                    <span class="las la-school icon"> </span>
                    <span class="title" Style="font-family: 'Lobster', cursive; font-size:2em;">Library</span>
                </a>
            </li>

            <li>
                <a href="dashboard.php">
                    <span class="las la-home icon"> </span>
                    <span class="title">Home</span>
                </a>
            </li>

            <li>
                <a href="manageCategories.php">
                    <span class="las la-file-contract icon"> </span>
                    <span class="title">Categories</span>
                </a>
            </li>

            <li>
                <a href="mangebooks.php ">
                    <span class="la la-book icon"> </span>
                    <span class="title">Books</span>
                </a>
            </li>

            <li>
                <a href="managequotes.php">
                    <span class="las la-signature icon"> </span>
                    <span class="title">Quotes</span>
                </a>
            </li>

            <li id="add-btn" style="cursor: pointer;"> 
                
                    <a>                   
                    <span class="las la-lock icon" > </span>
                    <span class="title">Password</span>
                    </a>
                
                
            </li>

            <li>
                <a href="../Homepage.php">
                    <span class="las la-user icon" > </span>
                    <span class="title">As User</span>
                </a>
            </li>


            <li>
                <a href="logout.php">
                    <span class="las la-sign-out-alt icon" > </span>
                    <span class="title">Sign out </span>
                </a>
            </li>

        </ul>            
        </div>

        <div class="update-form-container">

              <i class="las la-times" id="form-close"></i>


                <form action="" method="POST"  >
                <br> <br>
                <h3>  Password Setting </h3>
                    <input type="password" name="current_password"  class="box" placeholder="current password"   minlength="8" required> <br> <br>
                    <input type="password" name="new_password"  class="box" placeholder="new password"   minlength="8" required> <br> <br>                         
                    <input type="password" name="confirm_password"  class="box" placeholder="confirm password"   minlength="8" required> <br> <br>
                    <input type="submit" name="submit-update" value="Confirm" class="btn"><br> 
                    
                </form>

       </div>


       <script>
           let formClose = document.querySelector('#form-close');
           let updateForm = document.querySelector('.update-form-container');           
           let formBtn = document.querySelector('#add-btn');
           formBtn.addEventListener('click', () =>{
                updateForm.classList.add('active');
            });

           

            formClose.addEventListener('click', () =>{
                updateForm.classList.remove('active');
            });
       </script>

<?php 
if (isset($_POST['submit-update'])) {

            $id =$_SESSION['user_id'];

            $current_password = mysqli_real_escape_string($conn, (md5($_POST['current_password'])));
            $new_password = mysqli_real_escape_string($conn, (md5($_POST['new_password'])));
            $confirm_password = mysqli_real_escape_string($conn, (md5($_POST['confirm_password'])));
                
            $sql = "SELECT * FROM tbl_admin WHERE id='$id' AND password='$current_password'"; 

            $res = mysqli_query($conn, $sql); // execute que
            $count = mysqli_num_rows($res);

            if($count==1){
                // this mean have admin with this password , password current is correct!
            if($new_password == $confirm_password){
            // if($new_password != "d41d8cd98f00b204e9800998ecf8427e"){ // update with current password
                    // not can be , because you should enter all fileds
            // }
            //  else{
                    // have new and confirm password 
                    $sql4 = "UPDATE tbl_admin SET 
                    password = '$new_password'
                    WHERE id='$id'
                    ";
            //execute query ans save data in db                           
                    $res4 = mysqli_query($conn, $sql4);

                    //check if data insert or not, display message
                    if($res4 == true){
                    //create a session variable to display message
                    $_SESSION['update']=" <div class='alert'>                              
                                        <span class='msg'>          
                                        password Successfully Updated                                                                                     
                                        </span>
                                        <span class='close-btn'>
                                        <span class='la la-check'></span>
                                        </span>
                                        </div>";
                    //Redirect page
                // header("location:" . "dashboard.php");
                    }
                    else{
                    $_SESSION['update']="<div class='alert-error'>                    
                                        <span class='msg'>  password Failed Updated </span>
                                        <span class='close-btn-error'>
                                        <span class='la la-close'></span>
                                        </span>
                                        </div>";

                // header("location:" . "dashboard.php");
                    //Redirect page 
                    }

            // }//end else


            }
            else{
                //not equal new with confirm
                $_SESSION['pwd-not-match']=" <div class='alert-error'>                    
                                            <span class='msg'>  New Password and Confirm Password not match </span>
                                            <span class='close-btn-error'>
                                            <span class='la la-close'></span>
                                            </span>
                                            </div>";
            // header("location:" . "dashboard.php");
            }
            }
            else{ 

            // current password failed // not correct

            $_SESSION['user-not-found']="   <div class='alert-error'>                    
                                        <span class='msg'>   Current Password not match, Try again!   </span>
                                        <span class='close-btn-error'>
                                        <span class='la la-close'></span>
                                        </span>
                                        </div>";
                                        
            //header("location:" . "dashboard.php");

            }
}
?>