<?php include('adminpanel.php'); ?>
 <!--main -->
 <div class="main">
            <div class="topbar">
                    <div class="toggle">
                    <span class="las la-bars"></span>
                    </div>
                    <!--search -->
                    <div class="search">

                    <form action="searchbook.php" method="">
                    <label>
                        <input type="text" placeholder="Search here" name="search">
                        <span class="fas fa-search icon" > </span>
                    </label>
                    </form>

                    </div>
                    <!--user image -->
                    <div class="user"> 
                        <img src="../images/profile-img.png"  alt="">                                                           
                        
                    </div>
            </div>
<br><br>


           
            <div>
                    <?php
                    if (isset($_SESSION['pwd-not-match'])) {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }
        
                    if (isset($_SESSION['user-not-found'])) {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                     }

                     if (isset($_SESSION['update'])) {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                     }
                    ?>
            </div>

            <!--cards-->
            <div class="cardBox">
              <div class="card">
                  <div>
                  <?php
                        $sql4 = "SELECT * FROM categories";
                        $res4 = mysqli_query($conn, $sql4); // execute que
                        $count4 = mysqli_num_rows($res4);
                        ?>
                      <div class="number"><?php echo  $count4 ?></div>
                      <div class="cardName"> Categories</div>
                  </div>

                  <div class="iconBox">
                  <span class="las la-file-contract icon" > </span>                    
                  </div>

              </div>

              <div class="card">
                  <div>
                  <?php
                        $sql3 = "SELECT * FROM books";
                        $res3 = mysqli_query($conn, $sql3); // execute que
                        $count3 = mysqli_num_rows($res3);
                        ?>
                      <div class="number"><?php echo  $count3 ?></div>
                      <div class="cardName"> Books</div>
                  </div>

                  <div class="iconBox">
                  <span class="la la-book icon" > </span>                    
                  </div>

              </div>

              <div class="card">
                  <div>
                  <?php
                        $sql2 = "SELECT * FROM tbl_quotes";
                        $res2 = mysqli_query($conn, $sql2); // execute que
                        $count2 = mysqli_num_rows($res2);
                        ?>
                      <div class="number"><?php echo  $count2 ?></div>
                      <div class="cardName"> Quotes</div>
                  </div>

                  <div class="iconBox">
                  <span class="las la-signature icon" > </span>                    
                  </div>

              </div>

              <div class="card">
                  <div>
                        <?php
                        $sql = "SELECT * FROM tbl_admin";
                        $res = mysqli_query($conn, $sql); // execute que
                        $count = mysqli_num_rows($res);
                        ?>
                      <div class="number"><?php echo  $count ?></div>
                      <div class="cardName"> Admin</div>
                  </div>

                  <div class="iconBox">
                  <span class="las la-user icon" > </span>                    
                  </div>

              </div>
            </div>

        </div>

    </div>
    <script>
        //menu toggle
        let toggle = document.querySelector('.toggle');
        let main = document.querySelector('.main');
        let navigation = document.querySelector('.navigation');

        toggle.onclick = function(){
            navigation.classList.toggle('active');
            main.classList.toggle('active');
        }
        
        //add hovered class in selected list item
        let list = document.querySelectorAll('.navigation li');
        function activeLink() {
            list.forEach((item) => 
              item.classList.remove('hovered'));
              this.classList.add('hovered');
            
        }

        list.forEach((item) =>
        item.addEventListener('mouseover',activeLink));

        formBtn.addEventListener('click', () =>{
                updateForm.classList.add('active');
            });
   </script>
