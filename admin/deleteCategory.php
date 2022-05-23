
<?php
include('../constant.php');

// check passing value id and image_name or not 
if (isset($_GET['id']) ) {
  
    //get value and delete
    // 1.get id
    $id = $_GET['id'];
    $book_cover_URL= $_GET['image_name'];

     //remove the physical image file if avaliable
    if ($book_cover_URL != "") {
        //image avaliable // remove it
        $path = "../admin/Category-Assest/" . $book_cover_URL;
        $remove = unlink($path); //boolean
    }
    $sql="DELETE FROM categories WHERE Id=$id";
    //3.execute the query
    $res = mysqli_query($conn, $sql);
  
  
    //check if data insert or not, display message
  if ($res == true) {
  //Redirect page 
  header("location:" . "./manageCategories.php");
  }

 
    }
?>
  