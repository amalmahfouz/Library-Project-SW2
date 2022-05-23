<?php
include('adminpanel.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online library</title>
    <!-- font awesome cdn link  @ https://cdnjs.com/ The iconic SVG, font, and CSS toolkit  -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <!--  css file link  -->
    <link rel="stylesheet" href="../Category.css">
    

</head>

<div class="main">
            <div class="topbar">
                    <div class="toggle">
                    </div>
                    <!--search -->
                    <div class="search">
                   
                    <form action="searchbook.php" method="" style="margin-left: 0;">
                    <label>
                        <input type="text" placeholder="Search here" name="search">
                        <span class="fas fa-search icon" > </span>
                    </label>
                    </form>
                    </div>
                    <!--user image -->
                    <div class="user"> 
                        <img src="../images/profile-img.png"  alt="">                                                           
                        
                    </div>
            </div>
         <br><br>
         <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['no-Book-found'])) {
            echo $_SESSION['no-Book-found'];
            unset($_SESSION['no-Book-found']);
        }
        if (isset($_SESSION['unauthorize'])) {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['remove-failed'])) {
            echo $_SESSION['remove-failed'];
            unset($_SESSION['remove-failed']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>



<div class="details">
        <div class="recentOrders">
        <div class="cardHeader">
        <h1 class="heading" style="margin-top: -5%">

        <span>C</span>
        <span>A</span>
        <span>T</span>
        <span>E</span>
        <span>G</span>
        <span>O</span>
        <span>R</span>
        <span>Y</span>
            </h1>

        <a href="addCategory.php" class="btn-brimary">Add Category</a> 
        </div>


        
        <table class="tbl-full" style="  border-collapse: collapse;     font-size: 17px;
                                           
                                                width: 95%;"  >
       <thead>
       <tr>
                <th>Title</th>
                <th>Cover</th>
                <th>active</th>
                <th>Featured</th>
                <th>Actions</th>
            </tr>
       </thead>
         
            
            <?php 

            //creat sql
            $sql = "SELECT * FROM categories"; 
            $res = mysqli_query($conn, $sql); // execute query
            //check if query is execute or not, 
 $id=0;
            //count rows
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                //get data and display
                while ($rows = mysqli_fetch_assoc($res)) {
                    $id=$rows['Id'];
                    $title = $rows['title'];
                    $image_name = $rows['coverPhoto'];
                    $active = $rows['active'];
                    $featured=$rows['featured'];
                    ?>
                    <tr>
                         <td><?php echo $title; ?></td>
                        <td>
                           
                            <?php 
                            //check name image
                            if($image_name !=""){
                                ?>
                                <img style="width: 100px; height: 90px;" src="<?php echo "../admin/Category-Assest/".$image_name?>" >
                                <?php
                            }
                           
                            else{
                                echo "<divclass='error' >image not added </divclass=>";
                            }
                            ?>
                        </td>
                        <td><?php echo  $active; ?></td>
                        <td><?php echo  $featured; ?></td>
                        
                        <td>
                       
                      <button class="spase"> <a href="updateCategory.php?Id=<?php echo $id;?>" class="btn-secondary">Update</a></button> 
                         
                      <button class="spase btn-danger" style="padding:1%;" id="<?php echo $id ?>" onclick="archiveFunction(this.id,'<?php echo $image_name ?>' )"> Delete</button>
                        </td>
                    </tr>
                <?php
                }

            }
            else{
                echo "<tr> <td colspan='7' class='error'>Category not Added Yet </td></tr>";
             }
            ?>
            
        </table>

    </div>

</div>
<!--main content section ends -->
  
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
 <script>
   function archiveFunction(id,image_name) {
event.preventDefault(); // prevent form submit
var form = event.target.form; // storing the form
        swal({
  title: "Are you sure?",
  text: "But you will still be able to retrieve this file.",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, Delete it!",
  cancelButtonText: "No, cancel please!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
    if (isConfirm) {
    // this is `post` request to the server
    // so you can get the data from $_POST variables, says $_POST['delete'] $_POST['v_id']
    $.ajax({
        method: 'GET',
        data: {'id' : id, 'image_name':image_name },
        url: '../admin/deleteCategory.php',
        success: function(data) {
          
        }
    });
    swal("Updated!", "Your imaginary file has been Deleted.", "success");

setTimeout(window.location.reload(), 11000)
} else {
    swal("Cancelled", "Your file is safe :)", "error");
}
});
}
 </script>
 
    <!--fotter section ends-->
        </body>