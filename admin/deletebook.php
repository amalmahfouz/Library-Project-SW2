
<?php
include('../constant.php');

// check passing value id and image_name or not 
if (isset($_GET['id']) ) {
    //get value and delete
    // 1.get id
    $id = $_GET['id'];
    $book_cover_URL= $_GET['book_cover_URL'];
    $file_URL= $_GET['file_URL'];
    //remove the physical image file if avaliable
    if ($book_cover_URL != "") {
        //image avaliable // remove it
        $path = "../admin/books-Assest/" . $book_cover_URL;
        $remove = unlink($path); //boolean
        if ($remove == false) {
            //failed to remove image , erroe message and stop process
            $_SESSION['remove'] = "<div class='error'>Failed to Remove book Image</div>";
            header("location:" . "./mangebooks.php");
            die();
        }
    }
     //remove the physical image file if avaliable
     if ($file_URL!= "") {
      //image avaliable // remove it
      $path = "../admin/books-Assest/" . $file_URL;
      $remove = unlink($path); //boolean
      if ($remove == false) {
          //failed to remove image , erroe message and stop process
          $_SESSION['remove'] = "<div class='error'>Failed to Remove file</div>";
          header("location:" . "./mangebooks.php");
          die();
      }
  }
  $sql="DELETE FROM books WHERE id=$id";
  //3.execute the query
  $res = mysqli_query($conn, $sql);


  //check if data insert or not, display message
if ($res == true) {
//create a session variable to display message
$_SESSION['delete'] = " <div class='alert'>                              
                        <span class='msg'>          
                        Book Deleted Successfully                                                                                      
                        </span>
                        <span class='close-btn'>
                        <span class='la la-check'></span>
                        </span>
                        </div>";
//Redirect page 
header("location:" . "mangebooks.php");
} else
{
$_SESSION['delete'] =
                        "<div class='alert-error'>                    
                        <span class='msg'>   Failed to Delete Book!   </span>
                        <span class='close-btn-error'>
                        <span class='la la-close'></span>
                        </span>
                        </div>";
//Redirect page 
header("location:" . "mangebooks.php");
}    
  


}
else 
{ //redirect to managecate.
header("location:" . "mangebooks.php");

}

?>