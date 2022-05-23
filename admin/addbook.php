<?php
ob_start();
?>

<?php
include('adminpanel.php');
include('func-file-upload.php');

// title  author  description Catogryid  image files
$db = mysqli_connect('localhost', 'root', '', 'library');
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
      //  $id = input_data($_POST["id"]);
        $title = input_data($_POST["title"]); 
         $author  = input_data($_POST["author"]); 
         $description  = input_data($_POST["description"]); 
         $Catogryid  = input_data($_POST["Catogryid"]); 
         $active  = input_data($_POST["active"]); 
      
          # book cover Uploading
        $allowed_image_exs = array("jpg", "jpeg", "png");
        $path = "cover";
        $book_cover = upload_file($_FILES['image'], $allowed_image_exs, $path);
        if ($book_cover['status'] == "error") {
	    	$em = $book_cover['data'];
            header("Location: ./mangebooks.php?error=$em");
	    	exit;}

            else {
                # file Uploading
                $allowed_file_exs = array("pdf", "docx", "pptx");
                $path = "file";
                $file = upload_file($_FILES['files'], $allowed_file_exs);
                if ($file['status'] == "error") {
                    $em = $file['data'];
                    header("Location: ./addbook.php?error=$em");
                    exit;
                }    
                else {
                  
                    $file_URL = $file['data'];
                    $book_cover_URL = $book_cover['data'];}
                    
            
            }
         
}


function input_data($data) {  
    $data = trim($data);  
    $data = stripslashes($data);  
    $data = htmlspecialchars($data);  
    return $data;  
  }  
if (isset($_POST['submit'])) {
  mysqli_query($db, "INSERT INTO books (title,author,descripition,category_id,cover ,file,active) VALUES ( '$title' ,'$author' ,'$description' ,'$Catogryid' , '$book_cover_URL','$file_URL','$active')"); 
 
  if ($db == true) { //add..
    # success message
    $sm = "The book successfully created!";
    header("Location:"."addbook.php?success=".$sm);
    exit;

} else { //failed add
    $em = "Unknown Error Occurred!";
    header("Location:" . "addbook.php?error".$em);
    exit;
}


 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD Book</title>
    <link rel="stylesheet" href="../book.css">
   
</head>
<body>
<div class="main-content">
    <div class="wrapper">
        <h1 style="margin-left: 200px;">Add Book</h1> <br>
        <!-- Display error or sucess maseege  -->
        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error']); ?>
		  </div>
		<?php } ?>
		<?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
			  <?=htmlspecialchars($_GET['success']); ?>
		  </div>
		<?php } ?>
        <?php
    if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];
        unset($_SESSION['add']);}
        ?>
        <br>


        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                   
                <tr>
                    <td>Title : </td>
                    <td> <input type="text" name="title" placeholder="Title Of Book" required> </td>
                </tr>
                <tr>
                    
                <td>Author : </td>
                    <td> <input type="text" name="author" placeholder="Author Of Book" required> </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td> <textarea name="description" cols="30" rows="5" placeholder="Description Of Book" required></textarea> </td>
                </tr>
                <tr>
                    <td>Catogryid : </td>
                    <td>
                        <select name="Catogryid">

                            <?php
                            //display categories from database
                            //create sql to get all active category in db
                            $sql70 = "SELECT * FROM categories WHERE active='Yes'";
                            $res70 = mysqli_query($conn, $sql70);
                            //count rows
                            $count70 = mysqli_num_rows($res70);

                            if ($count70 > 0) //have cat
                            {
                                while ($row70 = mysqli_fetch_assoc($res70)) { //get detalies 
                                    $id_cat = $row70['Id'];
                                    $title_cat = $row70['title'];
                            ?>
                                    <option value="<?php echo $id_cat; ?>"><?php echo $title_cat; ?></option>
                                <?php

                                }
                            } else // no have cat
                            {
                                ?>

                                <option value="0">No Category Found</option>

                            <?php

                            }
                            //display dropdown
                            ?>
                        </select>
                    </td>
                </tr> 
                 <tr>
                    <td>Cover:</td>
                    <td>
                        <input type="file" name="image" required>
                    </td>
                </tr>
                <tr>
                     <td>File:</td>
                    <td>
                        <input type="file" name="files" required>
                    </td> 
                </tr>
                 <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" name="active" value="Yes" required checked> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr> 

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Book" class="btnAdd">
                    </td>
                </tr>
            </table>
           
        </form>


   
</body>
</html>