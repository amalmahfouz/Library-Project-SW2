<?php
ob_start();
?>
<?php
include('adminpanel.php');
include('func-file-upload.php');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];//10
            $res = mysqli_query(mysqli_connect('localhost', 'root', '', 'library'), "SELECT * FROM books WHERE id=$id");
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $rows = mysqli_fetch_assoc($res);
                $id = $rows['id'];
                $title = $rows['title'];
                $author = $rows['author'];
                $descripition = $rows['descripition'];
                $category_id = $rows['category_id'];//
                $current_cover = $rows['cover'];
                $current_file = $rows['file'];
                $active = $rows['active'];
            } else {

                $_SESSION['no-quote-found'] = "<div class='error'>book Not Found</div>";
                header("location:" . "managebooks.php");
            }
        } else {
            header("location:" . "managebooks.php");
        }
  
            // updata databas
    if (isset($_POST['submit'])) {
        if (!empty($_FILES['book_cover']['name'])) {
              /**
                if the admin try to 
                update both 
            **/
            if (!empty($_FILES['file']['name'])) {
                # update both here

                # book cover Uploading
              $allowed_image_exs = array("jpg", "jpeg", "png");
              $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs);

              # book cover Uploading
              $allowed_file_exs = array("pdf", "docx", "pptx");
              $path = "files";
              $file = upload_file($_FILES['file'], $allowed_file_exs);
              
              /**
                  If error occurred while 
                  uploading
              **/
              if ($book_cover['status'] == "error" || 
                  $file['status'] == "error") {

                  $em = $book_cover['data'];

                  /**
                    Redirect to '../edit-book.php' 
                    and passing error message & the id
                  **/
                  header("Location: ./updatebook.php?error=$em&id=$id");
                  exit;
              }else {
                # current book cover path
                $c_p_book_cover = "../uploads/cover/$current_cover";

                # current file path
                $c_p_file = "../uploads/files/$current_file";

                # Delete from the server
                unlink($c_p_book_cover);
                unlink($c_p_file);

                /**
                    Getting the new file name 
                    and the new book cover name 
                **/
                 $file_URL = $file['data'];
                 $book_cover_URL = $book_cover['data'];

                  # update just the data
                  $conn = mysqli_connect('localhost', 'root', '', 'library');
                  $res = mysqli_query($conn,"UPDATE books set  title='" . $_POST['title'] . "', author='" . $_POST['author'] . "' ,descripition='" . $_POST['descripition'] . "',active='" . $_POST['active'] . "', category_id='" . $_POST['category_id'] . "', cover='" . $book_cover_URL  . "', file='" . $file_URL . "' WHERE id='" . $_POST['id'] . "'");

                  /**
                    If there is no error while 
                    updating the data
                  **/
                   if ($res) {
                       # success message
                       $sm = "Successfully updated!";
                       header("location:" . "managebooks.php");
                      exit;
                   }else{
                       # Error message
                       $em = "Unknown Error Occurred!";
                       header("location:" . "managebooks.php");
                      exit;
                   }


              }
            }else {
                # update just the book cover

                # book cover Uploading
              $allowed_image_exs = array("jpg", "jpeg", "png");
              
              $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs);
              
              /**
                  If error occurred while 
                  uploading
              **/
              if ($book_cover['status'] == "error") {

                  $em = $book_cover['data'];

                  /**
                    Redirect to '../edit-book.php' 
                    and passing error message & the id
                  **/
                  header("Location: ./updatebook.php?error=$em&id=$id");
                  exit;
              }else {
                # current book cover path
                $c_p_book_cover = "../admin/books-Assest/$current_cover";

                # Delete from the server
                unlink($c_p_book_cover);

                /**
                    Getting the new file name 
                    and the new book cover name 
                **/
                 $book_cover_URL = $book_cover['data'];

                 $conn = mysqli_connect('localhost', 'root', '', 'library');
                 $res = mysqli_query($conn,"UPDATE books set  title='" . $_POST['title'] . "', author='" . $_POST['author'] . "' ,descripition='" . $_POST['descripition'] . "',active='" . $_POST['active'] . "',category_id='" . $_POST['category_id'] . "', cover='" . $book_cover_URL . "' WHERE id='" . $_POST['id'] . "'");

                  /**
                    If there is no error while 
                    updating the data
                  **/
                   if ($res) {
                       # success message
                       $sm = "Successfully updated!";
                       header("location:" . "managebooks.php");
                      exit;
                   }else{
                       # Error message
                       $em = "Unknown Error Occurred!";
                       header("location:" . "managebooks.php");
                      exit;
                   }


              }
            }
        }
        /**
        if the admin try to 
        update just the file

        **/
        else if(!empty($_FILES['file']['name'])){
            # update just the file
          
          # book cover Uploading
          $allowed_file_exs = array("pdf", "docx", "pptx");
          $path = "files";
          $file = upload_file($_FILES['file'], $allowed_file_exs);
          
          /**
              If error occurred while 
              uploading
          **/
          if ($file['status'] == "error") {

              $em = $file['data'];

              /**
                Redirect to '../edit-book.php' 
                and passing error message & the id
              **/
              header("Location: ./updatebook.php?error=$em&id=$id");
              exit;
          }else {
            # current book cover path
            $c_p_file = "../admin/books-Assest/$current_file";

            # Delete from the server
            unlink($c_p_file);

            /**
                Getting the new file name 
                and the new file name 
            **/
             $file_URL = $file['data'];

              # update just the data
              $conn = mysqli_connect('localhost', 'root', '', 'library');
              $res = mysqli_query($conn,"UPDATE books set  title='" . $_POST['title'] . "', author='" . $_POST['author'] . "' ,descripition='" . $_POST['descripition'] . "',active='" . $_POST['active'] . "',category_id='" . $_POST['category_id'] . "', file='" . $file_URL . "' WHERE id='" . $_POST['id'] . "'");
              /**
                If there is no error while 
                updating the data
              **/
               if ($res) {
                   # success message
                   $sm = "Successfully updated!";
                   header("location:" . "managebooks.php");
                  exit;
               }else{
                   # Error message
                   $em = "Unknown Error Occurred!";
                   header("location:" . "managebooks.php");
                  exit;
               }


          }
        
        }else {
            # update just the data
            $conn = mysqli_connect('localhost', 'root', '', 'library');
                  $res = mysqli_query($conn,"UPDATE books set  title='" . $_POST['title'] . "', author='" . $_POST['author'] . "' ,descripition='" . $_POST['descripition'] . "',active='" . $_POST['active'] . "',category_id='" . $_POST['category_id'] . "' WHERE id='" . $_POST['id'] . "'");
          /**
            If there is no error while 
            updating the data
          **/
           if ($res) {
               # success message
               $sm = "Successfully updated!";
               
               header("location:" . "mangebooks.php");
              exit;
           }else{
               # Error message
               $em = "Unknown Error Occurred!"; 
               header("location:" . "mangebooks.php");
              exit;
           }
        } 
  }?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Books</title>
    <link rel="stylesheet" href="../book.css">
</head>
<body>
<div class="main-content">
    <div class="wrapper">
        <h1 style="margin-left:250px ;">Update Book </h1> <br>
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
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
            <tr>
            <td>ID : </td>
                <td> <input type="text" name="id" placeholder="ID Of Book" required value="<?php echo $id ?>" readonly> </td>
    </tr>
            <tr>
                <td>Title : </td>
                <td> <input type="text" name="title" placeholder="Title Of Book" required value="<?php echo $title ?>"> </td>
            </tr>
            <tr>
                
            <td>Author : </td>
                <td> <input type="text" name="author" placeholder="Author Of Book" required value="<?php echo $author ?>" > </td>
            </tr>
            <tr>
                <td>Description: </td>
                <td> <textarea name="descripition" cols="30" rows="5" placeholder="Description Of Book" required> <?php echo $descripition ?></textarea> </td>
            </tr>
            <tr>
                <td>Catogryid: </td>
                <td>
                <select name="category_id">

                            <?php
                            //display categories from database
                            //create sql to get all active category in db
                            $sql50 = "SELECT * FROM categories WHERE active='Yes'";
                            $res50 = mysqli_query($conn, $sql50);
                            //count rows
                            $count50 = mysqli_num_rows($res50);

                            if ($count50 > 0) //have cat
                            {
                                while ($row50 = mysqli_fetch_assoc($res50)) { //get detalies 
                                    $category_id_row = $row50['Id'];
                                    $category_title_row = $row50['title'];
                            ?>
                                    <option <?php if ($category_id == $category_id_row) {
                                                echo "selected";
                                            } ?> value="<?php echo $category_id_row; ?>"><?php echo $category_title_row; ?></option>
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
                <td>active: </td>
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
                <td>Cover:</td>
  
                <td>
                <input type="file" 
		           class="form-control" 
		           name="book_cover"> 
                   </td> </tr>

                   <tr> 
                   <td>CoverPrev:</td>
                  <td> <input type="text"  hidden   value="<?=$current_cover?>" name="current_cover">
		            <a href="../admin/books-Assest/<?=$current_cover?>"
		           class="linkdark" style="text-decoration: underline;  color: #212529;   display:inline-block;">Current Cover</a>
                   </td> </tr>
		           
                    
            
           
            <tr>
                 <td>File:</td>
                <td>                   
                    <input type="file" class="form-control" 
		           name="file"  >
                </td> 
            </tr>

            <tr> 
                   <td>FilePrev:</td>
                  <td> <input type="text"  hidden   value="<?=$current_file?>" name="current_file">
		            <a href="../admin/books-Assest/<?=$current_file?>"
		           class="linkdark" style="text-decoration: underline;  color: #212529;   display:inline-block;">Current File</a>
                   </td> </tr>
             

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Update Book" class="btnAdd" value="Update books" >
                </td>
            </tr>

            </table>
        </form>

    </div> 
    </div>
</body>
</html>