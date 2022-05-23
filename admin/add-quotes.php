<?php
ob_start();
?>
<?php include('adminpanel.php'); ?>
<div class="main">
            <div class="topbar">
                    <div class="toggle">
                    <span class="las la-bars"></span>
                    </div>
                    <!--search -->
                    <div class="search">
                    <form action="searchbook.php" method="">
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


         <div class="details">
             <div class="recentOrders">
                 <div class="cardHeader">
                    <h2>  Add Quotes  </h2>                    
                 </div> 

                <form action="" method="POST" enctype="multipart/form-data">
                    <table >
                        <tr>
                            <td>Content :</td>
                            <td>
                                <textarea  style="border-radius: 6px;" name="content" placeholder=" content" rows="5" cols="40"   required></textarea>
                        </td>

                        </tr>
                        <tr>
                            <td>Title :</td>
                            <td>
                                <input style="border-radius: 6px;width:300px;" type="textarea" name="author" placeholder=" title"  minlength="3" required>
                            </td>

                        </tr> 
                        <tr>
                            <td>Active :</td>
                            <td>
                                <input type="radio" name="active" value="Yes" checked> Yes
                                <input type="radio" name="active" value="No"> No
                            </td>
                        </tr>
                        
                        <tr>
                            
                            <td colspan="2">
                                <input style="top:15px; right:-230px;" type="submit" class="btn" name="submit" value="Add quotes" class="btn-secondary">
                            </td>
                        </tr>               
                    </table>
                </form>

    </div>
</div>




<?php
$db = mysqli_connect('localhost', 'root', '', 'library');
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
        $content = input_data($_POST["content"]); 
         $author = input_data($_POST["author"]);  

}
function input_data($data) {  
    $data = trim($data);  
    $data = stripslashes($data);  
    $data = htmlspecialchars($data);  
    return $data;  
  }  
if (isset($_POST['submit'])) {
    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = "No";
    }
   mysqli_query($db, "INSERT INTO tbl_quotes (content, title,active) VALUES ('$content', '$author','$active')"); 
if ($db == true) { //add..
    $_SESSION['add']=  " <div class='alert'>                              
                        <span class='msg'>          
                        Quotes add Successfully                                                                                     
                        </span>
                        <span class='close-btn'>
                        <span class='la la-check'></span>
                        </span>
                        </div>";
    header("location:" . "managequotes.php");
} else { //failed add
    $_SESSION['add'] ="<div class='alert-error'>                    
                    <span class='msg'>  Quotes Failed added </span>
                    <span class='close-btn-error'>
                    <span class='la la-close'></span>
                    </span>
                    </div>";
    header("location:" . "managequotes.php");
}


 }
?>

<?php include('footer.php'); ?>