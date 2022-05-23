<?php include('header-user.php');

?>


<!-- home section starts  -->

<section class="home" id="home">

    <div class="row">

        <div class="content">
            <h3>There is No ,
                Friend as Loyal as a book
            </h3>
            <p>“Show me a family of readers, and I will show you 
                the people who move the world.” 
                Napoléon Bonaparte (French military and political leader)
            </p>
            
        </div>

        <div class="swiper books-slider">
            <div class="swiper-wrapper">
                <a href="#" class="swiper-slide"><img src="images/book-1.png" alt=""></a>
                <a href="#" class="swiper-slide"><img src="images/book-2.png" alt=""></a>
                <a href="#" class="swiper-slide"><img src="images/book-3.png" alt=""></a>
                <a href="#" class="swiper-slide"><img src="images/book-4.png" alt=""></a>
                <a href="#" class="swiper-slide"><img src="images/book-5.png" alt=""></a>
                <a href="#" class="swiper-slide"><img src="images/book-6.png" alt=""></a>
            </div>
            <img src="images/stand.png" class="stand" alt="">
        </div>

    </div>

</section>

<!-- home section ense  -->

<!-- Categories section starts  -->

<section class="Categories" id="Categories">

    <h1 class="heading">
        <span>E</span>
        <span>x</span>
        <span>p</span>
        <span>l</span>
        <span>o</span>
        <span>r</span>
        <span>e</span>
    </h1>

    <div class="box-container">

        <?php
        //create sql query to display cat form db
        $sql = "SELECT * FROM categories WHERE active='Yes' AND featured='Yes' LIMIT 3";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            //found cat in db
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
                            <h3> <?php  echo $title?> </h3>
                        </a>
                    </div>
                </div>

        <?php
            }

        } else {
            // no cat in db
            echo "<div class='error'> Category Not Added</div>";
        }
        ?>
    </div>
</section>

<!-- Categories section ends -->


<!-- menu section starts  -->

<div class="menu" id="menu">

    <h1 class="heading">
        <span>Q</span>
        <span>U</span>
        <span>O</span>
        <span>T</span>
        <span>E</span>
        <span>S</span>
    </h1>
    <div class="menu_box-container">

        <?php
        $sql2 = "SELECT * FROM tbl_quotes WHERE active='Yes' LIMIT 8";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);
        if ($count2 > 0) {
            //found food in db
            while ($row = mysqli_fetch_assoc($res2)) {
                $id = $row['id'];
                $title = $row['title'];
                $content = $row['content'];

        ?> 
         <div class="box">                   
                       <h3 > <?php echo $title?></h3>
                      
                       <p><?php  echo '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;'. $content?></p>
         </div>
                <?php
                   }
          
         ?>
         <?php
          }
          else {
            // no cat in db
            echo "<div class='error'> Quotes Not Added</div>";
        }
        ?>

           

    </div>
   
</div>


<!-- menu section ends -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".books-slider", {
    loop:true,
    centeredSlides: true,
    autoplay: {
      delay: 9500,
      disableOnInteraction: false,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });
</script>
<?php include('footer-user.php'); ?>


