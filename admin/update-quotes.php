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
                    <h2>  Update Quotes  </h2>                    
                 </div> 
        <?php
       // $db = mysqli_connect('localhost', 'root', '', 'library');
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            $res = mysqli_query(mysqli_connect('localhost', 'root', '', 'library'), "SELECT * FROM tbl_quotes WHERE id=$id");
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $rows = mysqli_fetch_assoc($res);
                $content = $rows['content'];
                $author = $rows['title'];
                $active = $rows['active'];
            } else {

                $_SESSION['no-quote-found'] = 
                                                "<div class='alert-error'>                    
                                                    <span class='msg'>  Qutes Not Found </span>
                                                    <span class='close-btn-error'>
                                                    <span class='la la-close'></span>
                                                    </span>
                                                    </div>";
                header("location:" . "managequotes.php");
            }
        } else {
            header("location:" . "managequotes.php");
        }

        ?> 
        <form action="" method="POST" enctype="multipart/form-data">
            <table >
                <tr>
                    <td>content : </td>
                   <td> <textarea  name="content"  rows="5" cols="40"    required><?php echo $content ?></textarea>

                </tr>
                <tr>
                    <td>Title : </td>
                    <td><input type="text" name="author" value="<?php echo $author ?>"> </td>
                </tr>

                <tr>
                    <td>Active :</td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>


                
                <tr>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Quotes" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>


        <?php
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
            // updata databas
    if (isset($_POST['submit'])) {
        $active = $_POST['active'];
        $res = mysqli_query(mysqli_connect('localhost', 'root', '', 'library'), "UPDATE tbl_quotes SET content='$content', title='$author' , active='$active' WHERE id=$id");

     if ($res == true) { //updating..
        $_SESSION['update'] =
                                    " <div class='alert'>                              
                                    <span class='msg'>          
                                    quotes Updated Successfully                                                                                    
                                    </span>
                                    <span class='close-btn'>
                                    <span class='la la-check'></span>
                                    </span>
                                    </div>";
        header("location:" . "managequotes.php");
    } else { //failed updating
        $_SESSION['update'] = 
                     "<div class='alert-error'>                    
                    <span class='msg'>  Quotes Updated Failed </span>
                    <span class='close-btn-error'>
                    <span class='la la-close'></span>
                    </span>
                    </div>";
        header("location:" . "managequotes.php");
        }
    }

        ?>
    </div>
</div>
<?php include('footer.php'); ?>