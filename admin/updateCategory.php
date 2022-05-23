<?php
include('adminpanel.php');
$statusMsg ="";
$titleErr="";
        if (isset($_GET['Id'])) {
            $id = $_GET['Id'];
            $res = mysqli_query(mysqli_connect('localhost', 'root', '', 'library'), "SELECT * FROM categories WHERE Id=$id");
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $rows = mysqli_fetch_assoc($res);
                $id = $rows['Id'];
                $title = $rows['title'];
                $current_cover = $rows['coverPhoto'];
                 $active = $rows['active'];
                 $featured =$rows['featured'];
            }
             
        } else {
            header("location:" . "manageCategories.php");
        }
  
            // updata databas
    if (isset($_POST['submit'])) {

// File upload path
$targetDir = "../admin/Category-Assest/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(!empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                # current book cover path
                $c_p_book_cover = "../admin/Category-Assest/$current_cover";
                # Delete from the server
                unlink($c_p_book_cover);
                $conn = mysqli_connect('localhost', 'root', '', 'library');
                if($_POST['title'] == ''){
                    $conn = mysqli_connect('localhost', 'root', '', 'library');
                    $res = mysqli_query($conn,"UPDATE categories set  title='" . $title . "', active='" . $_POST['active'] . "' ,featured='" . $_POST['featured'] . "', coverPhoto='" . $fileName  . "' WHERE Id='" . $id . "'");
                    if($res == true){
                        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>';
                        echo '<script type="text/javascript">';
                        echo 'swal("Good job!", "‘Updated successfully", "success")';
                        echo '</script>';
                      }  
                }
                else{
                    $conn = mysqli_connect('localhost', 'root', '', 'library');
                    $res = mysqli_query($conn,"UPDATE categories set  title='" . $_POST['title'] . "', active='" . $_POST['active'] . "' ,featured='" . $_POST['featured'] . "', coverPhoto='" . $fileName  . "' WHERE Id='" . $id . "'");
                    if($res == true){
                        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>';
                        echo '<script type="text/javascript">';
                        echo 'swal("Good job!", "‘Updated successfully", "success")';
                        echo '</script>';
                      }  
                }
   
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
         }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.';
    }
} 
elseif($_POST['title'] == ''){
    $conn = mysqli_connect('localhost', 'root', '', 'library');
    $res = mysqli_query($conn,"UPDATE categories set  title='" . $title . "', active='" . $_POST['active'] . "' ,featured='" . $_POST['featured'] . "', coverPhoto='" . $current_cover  . "' WHERE Id='" . $id . "'");
    if($res == true){
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>';
        echo '<script type="text/javascript">';
        echo 'swal("Good job!", "‘Updated successfully", "success")';
        echo '</script>';
      }  
}
else{
    $conn = mysqli_connect('localhost', 'root', '', 'library');
    $res = mysqli_query($conn,"UPDATE categories set  title='" . $_POST['title'] . "', active='" . $_POST['active'] . "' ,featured='" . $_POST['featured'] . "', coverPhoto='" . $current_cover  . "' WHERE Id='" . $id . "'");
    if($res == true){
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>';
        echo '<script type="text/javascript">';
        echo 'swal("Good job!", "‘Updated successfully", "success")';
        echo '</script>';
      }  
}

    

} 
              
            
           

 
       
            

     

        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
    <link rel="stylesheet" href="../Category.css">
</head>
<body>
<div class="main-content">
    <div class="wrapper">
        <h1 style="margin-left:250px ;">Update Category </h1> <br>
        
         <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
            <tr>
                <td class="tbltd">Title : </td>
                <td class="tbltd"><input type="text" class="inputText" name="title" value="<?php echo $title; ?>">
                        <span class="error">* <?php echo $titleErr; ?> </span>
                </td>
            </tr>
             <tr>
                <td class="tbltd">Cover:</td>
  
                <td class="tbltd">
                <input type="file" class="inputFile" name="file">
                        <span class="error1">* <?php echo $statusMsg; ?> </span>  
              

                   <tr> 
                   <td class="tbltd">CoverPrev:</td>
                  <td class="tbltd"> <input type="text"  hidden   value="<?=$current_cover?>" name="current_cover">
		            <a href="../admin/Category-Assest/<?=$current_cover?>"
		           class="linkdark" style="text-decoration: underline;  color: #212529;   display:inline-block;">Current Cover</a>
                   </td> </tr>
                   <tr>
                    <td class="tbltd">Active :</td>
                    <td class="tbltd">
                    <?php if($active=='Yes'): ?>
                        <input type="radio" name="active" value="Yes" checked > Yes
                        <input type="radio" name="active" class="inputRadio" value="No"> No
                   <?php else: ?>
                        <input type="radio" name="active" value="Yes"  > Yes
                        <input type="radio" name="active" class="inputRadio" checked value="No"> No
                   <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="tbltd">Featured :</td>
                    <td class="tbltd">
                    <?php if($featured=='Yes'): ?>
                        <input type="radio" name="featured" value="Yes" checked> Yes
                        <input type="radio" name="featured" value="No" class="inputRadio"  > No
                        <?php else: ?>
                            <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No" class="inputRadio" checked > No
                        <?php endif; ?>
                    </td>
                </tr>
                    
            
          
 
                <td colspan="2" class="tbltd">
                    <input type="submit" name="submit" value="Update Book" class="btnAdd" value="Update books" >
                </td>
            </tr>

            </table>
        </form>

    </div> 
    </div>
</body>
</html>