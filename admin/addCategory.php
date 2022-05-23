<?php
include('adminpanel.php');
$statusMsg ="";
$titleErr="";
 // title  author  description Catogryid  image files
$db = mysqli_connect('localhost', 'root', '', 'library');
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
        $title = input_data($_POST["title"]); 
        $active  = input_data($_POST['active']); 
        $featured  = input_data($_POST['featured']); 
        if (!preg_match ("/^[a-zA-z]*$/", $title) ) {  
            $titleErr = "Only alphabets and whitespace are allowed.";  
        }
        elseif(empty($title)){
            $titleErr = "Title is required";
        }
        // File upload path
        $targetDir = "../admin/Category-Assest/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        
        if(!empty($_FILES["file"]["name"])){
            // Allow certain file formats
            $allowTypes = array('jpg','png','jpeg','gif','PNG');
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                    
                }else{
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            }else{
                $statusMsg = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.';
            }
        }else{
            $statusMsg = 'Please select a file to upload.';
        }
        if(isset($_POST["submit"])){
            if($statusMsg=="" && $titleErr==""){
                mysqli_query($db,"INSERT into categories ( title, coverPhoto,featured,active) VALUES ('$title' ,'$fileName' ,'$featured' ,'$active')");
                if($db == true){
                    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>';
                    echo '<script type="text/javascript">';
                    echo 'swal("Good job!", "Added successfully", "success")';
                    echo '</script>';
                  }
            }
        }
}
function input_data($data) {  
    $data = trim($data);  
    $data = stripslashes($data);  
    $data = htmlspecialchars($data);  
    return $data;  
  }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD Category</title>
    <link rel="stylesheet" href="../category.css">
   
</head>
<body>
<div class="main-content">
    <div class="wrapper">
        <h1 style="margin-left: 200px;">Add Category</h1> <br>	

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                </tr>  
                <tr>
                    <td class="tbltd">Title : </td>
                    <td class="tbltd"> 
                        <input type="text" class="inputText" name="title" placeholder="Title Of Category">
                        <span class="error">* <?php echo $titleErr; ?> </span>  
                 </td>
                </tr>
                <tr>

                 <tr>
                    <td class="tbltd">Cover:</td>
                    <td class="tbltd">
                        <input type="file" class="inputFile" name="file">
                        <span class="error1">* <?php echo $statusMsg; ?> </span>  
                    </td>
                </tr>
                <tr>
                    <td class="tbltd">Active :</td>
                    <td class="tbltd">
                        <input type="radio" name="active" value="Yes" checked > Yes
                        <input type="radio" name="active" class="inputRadio" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td class="tbltd">Featured :</td>
                    <td class="tbltd">
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No" class="inputRadio" checked > No
                    </td>
                </tr>
                <tr>
                    <td class="tbltd" colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btnAdd">
                    </td>
                </tr>
            </table>
           
        </form>


   
</body>
</html>