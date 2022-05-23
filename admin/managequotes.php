<?php include('adminpanel.php'); ?>
<!--main content section starts-->

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
        
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['no-qoutes-found'])) {
            echo $_SESSION['no-qoutes-found'];
            unset($_SESSION['no-qoutes-found']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }

        
        
        ?>
        <br>



<div class="details">
             <div class="recentOrders">
                 <div class="cardHeader">
                    <h2>  Manage Quotes  </h2>
                    <a href="add-quotes.php" class="btn" id="add-btn">Add quotes</a>
                 </div>
                 <table>
                     <thead>
                         <tr>
                             <td> S.N </td>
                             <td> content </td>
                             <td> Title </td>
                             <td> Active </td>
                             <td> Action</td>
                         </tr>
                     </thead>
                     <tbody>
                     <?php
                        $sql = "SELECT * FROM tbl_quotes"; // query
                        $res = mysqli_query($conn, $sql); // execute query
                         //count rows
                        $count = mysqli_num_rows($res);
                        if ($count > 0) {
                            //get data and display
                            while ($rows = mysqli_fetch_assoc($res)) {
                                $id = $rows['id'];
                                $content_quote = $rows['content'];
                                $title = $rows['title'];
                                $active = $rows['active'];
                        ?>
                         <tr>
                         <td><?php echo $id;?></td>
                        <td><?php echo $content_quote; ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $active; ?></td>

                        <td>
                            <a href="update-quotes.php?id=<?php echo $id;?>" class="btn-secondary">Update</a>
                            <a href="deletequote.php?id=<?php echo $id;?>" class="btn-danger">Delete</a>
                        </td>
                            
                         </tr>
                         <?php
                         }
                        } 
                         else //no data in db 
                         {                        
                         ?> 
                             <tr>
                                 <td colspan="4">
                                <div class="error">NO Quetos Added..!  </div>
                                 </td>
                            </tr>
                        <?php  
                         }
                        
                         
                         ?>

                     </tbody>
                 </table>
             </div>
         </div>


</div>

<?php include('footer.php'); ?>