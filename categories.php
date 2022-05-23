<?php include('header-user.php'); ?>
<!-- Categories section starts  -->

<section class="Categories" id="Categories">

    <br><br><br><br><br> <br>

    <div class="box-container">

        <?php
        //display all cat are active
        $sql = "SELECT * FROM categories WHERE active='Yes'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                //image and title and id 
                $id = $row['Id'];
                $title = $row['title'];
                $image_name = $row['coverPhoto'];
        ?>       
                <div class="box">
                    <?php
                    //check image avaliable or not
                    if ($image_name == "") {
                        echo "<div class='error'>Image Not Avaliable </div>";
                    } else {
                    ?>
                       <a href="<?php echo  'category-book.php?category_id=' . $id ?>">
                       <img src="<?php echo './admin/Category-Assest/' . $image_name ?>" alt=""></a>
                    
                    <?php
                   }

                    ?>

                    <div class="content">
                    <a href="#">
                            <h3> <?php echo $title;?> </h3>
                        </a>
                    </div>
                </div>
        <?php
            }
        } else {
            //not avaliable
            echo "<div class='error'> Category Not Found</div>";
        }
        ?>
    </div>
</section>

<!-- Categories section ends -->
<?php include('footer-user.php'); ?>