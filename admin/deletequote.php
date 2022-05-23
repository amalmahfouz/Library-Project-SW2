<?php 
include('../constant.php');
 // check passing value id and image_name or not 
 if(isset($_GET['id'])){
     //get value and delete
     // 1.get id
         $id = $_GET['id'];
        $sql="DELETE FROM tbl_quotes WHERE id=$id";
        //3.execute the query
        $res = mysqli_query($conn, $sql);


        //check if data insert or not, display message
    if ($res == true) {
    //create a session variable to display message
    $_SESSION['delete'] = 
                            " <div class='alert'>                              
                            <span class='msg'>          
                            Quotes Deleted  Successfully                                                                                  
                            </span>
                            <span class='close-btn'>
                            <span class='la la-check'></span>
                            </span>
                            </div>";
    
    //Redirect page 
    header("location:" . "managequotes.php");
    } else
    {
    $_SESSION['delete'] = "<div class='alert-error'>                    
                            <span class='msg'>  Failed to Delete Quote !.. Try again later </span>
                            <span class='close-btn-error'>
                            <span class='la la-close'></span>
                            </span>
                            </div>";
    //Redirect page 
    header("location:" . "managequotes.php");
    }    
        
 }
 else 
 { //redirect to managecate.
    header("location:" . "managequotes.php");

 }
 ?>