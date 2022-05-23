<?php 
                 if(isset($_POST['search'])){
                  $searchkey= $_POST['search'];
                  $sql = "SELECT * FROM   books WHERE title LIKE '%$searchkey%'	 " ; // query
                 }else{
                  $sql = "SELECT * FROM   books "; // query
                  $searchkey="";
                  }

?>

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
    <!--  css file link  -->
    <link rel="stylesheet" href="../book.css">
    

</head>

<div class="main">
            <div class="topbar">
                    <div class="toggle">
                    <span class="las la-bars"></span>
                    </div>
                    <!--search -->
                    <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <span class="fas fa-search icon" > </span>
                    </label>
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
        <br>

<div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
            <h1 class="heading" style="margin-top: -5%">

                <span>B</span>
                <span>O</span>
                <span>O</span>
                <span>K</span>
                <span>S</span>
                </h1>
           
            <a href="addbook.php" class="btn-brimary">Add Books</a> 
            </div>




        <table class="tbl-full" style=" width: 95%;"  ;>
       
            <tr>
                <th >ID</th> 
                <th>Title</th>
                <th>Author</th>
                <th>Descripition</th>
                <th>active</th>
                <th>Cover</th>
                <th>File</th>
                <th>action</th>
            </tr>
            
            <?php 

            //creat sql
            $searchkey= $_GET['search'];
            $sql = "SELECT * FROM   books WHERE title LIKE '%$searchkey%'" ; // query
            $res = mysqli_query($conn, $sql); // execute query
            //check if query is execute or not, 

            //count rows
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                //get data and display
                while ($rows = mysqli_fetch_assoc($res)) {
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $author = $rows['author'];
                    $descripition = $rows['descripition'];
                    $category_id = $rows['category_id'];
                    $image_name = $rows['cover'];
                    $file = $rows['file'];
                    $active = $rows['active'];
                    
                   

                    ?>
                    <tr>
                    <td ><?php echo $id;?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo  $author; ?></td>
                        <td><?php echo  $descripition; ?></td>
                        <td><?php echo  $active; ?></td>
                        <td>
                           
                            <?php 
                            //check name image
                            if($image_name !=""){
                                ?>
                                <img src="<?php echo "../admin/books-Assest/".$image_name?>" width="80px " height="100px">
                                <?php
                                
                            }
                           
                            else{
                                echo "<divclass='error' >image not added </divclass=>";
                            }
                            ?>
                        </td>
                        <td>
                        
                            <?php 
                            //check file
                            if($file !=""){
                                ?>
                            <a style="color:black;" href="<?php echo "../admin/books-Assest/".$file?>" ><?=$title?></a>	
					        </a>
						
                                <?php
                            }
                            else{
                                echo "<div class='error'>file not added </div>";
                            }
                            ?>
                        </td>
                        
                        <td>
                       
                      <button class="spase"> <a href="updatebook.php?id=<?php echo $id;?>" class="btn-secondary">Update</a></button> 
                        
                      <button class="spase"> <a href="deletebook.php?id=<?php echo $id;?>" class="btn-danger">Delete</a></button>
                          
                        </td>
                    </tr>
                <?php
                }

            }
            else{
                echo "<tr> <td colspan='7' class='error'>Books not Added Yet </td></tr>";
                //not food in db
            }
            ?>
            
        </table>

    </div>

</div>
<!--main content section ends -->
  
    </div>
    </div>
 
 
    <!--fotter section ends-->
        </body>