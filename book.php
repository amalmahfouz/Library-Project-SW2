<?php include('header-user.php'); ?>

<!-- menu section starts  -->

<div class="menu" id="menu">

    <h1 class="heading" style="margin-top: 5%">

        <span>B</span>
        <span>O</span>
        <span>O</span>
        <span>K</span>
    </h1>
    <div class="menu_box-container1">
    <?php


    //display all cat are active
    $sql = "SELECT * FROM books WHERE active='Yes'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $author=$row['author'];
                $descripition = $row['descripition'];
                $image_name = $row['cover'];
                $file=$row['file'];
            ?>
            <div class="box">
                    <?php 

                    //check image avaliable or not
                    if ($image_name == "") {
                        echo "<div class='error'>Image Not Avaliable </div>";
                    } else {
                    ?>
                      <img src="<?php echo './admin/books-Assest/' . $image_name ?>" alt=""></a>

                    <?php
                    }
                    ?>                   
                    <div class="menu-content">
                        <h3> <?php  echo $title;?></h3>
                        <h5> <?php echo 'Author: '. $author ;?></h5>
                        <p><?php  echo $descripition;?> </p>
                        <?php 
                                  //check file
                                  if($file !=""){
                        ?>        
                                  
                                  <a  href="<?php echo "../admin/books-Assest/".$file?>" >
                                  <button class="btn">Explore the book</button>
                                   </a>	
                  
                                      <?php
                                      }
                                      ?>
                                </div>
                                </div>
                                <?php
                                    }
                                    ?>
                            
                        <?php
                   }
                
                else
                {
                  //not avaliable
                  echo "<div class='error'> Book Not Found</div>";
                }
            
                ?>
            

</div>
</div>

<!-- menu section ends -->
<?php include('footer-user.php'); ?>