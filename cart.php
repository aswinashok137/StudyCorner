<!DOCTYPE>
<?php
include("functions/functions.php");

?>
<html>
  <head>
    <title>STUDY CORNER</title>
    <link rel="stylesheet" href="styles/style.css" media="all" />
  </head>

  <body>
    <!-- Main Container starts here-->
    <div class="main_wrapper">

      <!--Header Container starts here-->
      <div class="header_wrapper">
        <a href="index.php"><img id="logo" src="images/logo.jpg" alt=""></a>
        <a href="index.php"><img id="banner" src="images/ad_banner.jpg" alt=""></a>
      </div>
      <!-- Header Container ends here-->

      <!-- Navigation Bar starts here-->
      <div class="menubar">
          <ul id="menu">
            <li> <a href="index.php">Home</a></li>
            <li> <a href="all_books.php">All Books</a></li>
            <li> <a href="student/my_account.php">My Account</a></li>
            <li> <a href="#">Sign Up</a></li>
            <li> <a href="cart.php">Shopping Cart</a></li>
            <li> <a href="#">Contact Us</a></li>
          </ul>
          <div id="form">
            <form class="" action="results.php" method="get" enctype="multipart/form-data">
              <input type="text" name="user_query" value="" placeholder="Search a Book" />
              <input type="submit" name="search" value="Search">
            </form>

          </div>
      </div>
      <!-- Navigation Bar ends here-->

      <!-- Content Wrapper starts here-->
      <div class="content_wrapper">
        <div id="sidebar">
                    <div id="sidebar_title">Branch</div>

                    <ul id="branch">

                    <?php getBranch() ?>

                    </ul>

                    <div id="sidebar_title">Semester</div>
                      <ul id="branch">
                          <?php getSem() ?>
                      </ul>
            </div>

            <div id="content_area">
                <?php  cart(); ?>
               <div id="shopping_cart">

                  <span style="float:right; font-size:18px; padding:5px; line-height:40px;">
                    Welcome Guest! <b style="color:yellow"> Shopping Cart </b>
                    Total Items:<?php total_iems(); ?> Total Price:<?php total_price(); ?>
                    <a href="cart.php" style="color:yellow">Go to Cart</a>
                  </span>
              </div>
              <?php echo $ip=getIp(); ?>

              <div id="books_box">
                  <br>
              <form action="" method="post" enctype="multipart/form-data">

              <table align="right" width="800" bgcolor="skyblue">

                <tr align="center">
                  <th>Remove</th>
                  <th>Book(S)</th>
                  <th>Quantity</th>
                  <th>Total Price</th>
                </tr>

                <?php

                $total=0;

                global $con;

                $ip=getIp();

                $sel_price="select * from cart where ip_add='$ip'";

                $run_price=mysqli_query($con, $sel_price);

                while ($b_price=mysqli_fetch_array($run_price)) {

                  $buk_id=$b_price['b_id'];

                  $buk_price="select * from books where book_id='$buk_id'";

                  $run_buk_price=mysqli_query($con,$buk_price);

                  while ($bb_price=mysqli_fetch_array($run_buk_price)) {

                    $book_price=array($bb_price['book_price']);

                    $book_title=$bb_price['book_title'];

                    $book_image=$bb_price['book_image'];

                    $single_price=$bb_price['book_price'];

                    $values=array_sum($book_price);

                    $total += $values;

                 ?>
                 <tr align="center">
                   <td><input type="checkbox" name="remove[]" value="<?php echo $buk_id;?>"/></td>
                   <td><b><?php echo $book_title ?></b><br>
                     <img src="admin_area/book_images/<?php echo $book_image;?>" width="60" height="60" />
                   </td>
                   <td><input type="text" size="4" name="qty" disabled=""></td>
                   <td><?php echo $single_price;  ?></td>
                 </tr>

                 <?php }} ?>

                 <tr >
                   <td colspan="4" align="right"><b>Sub Total:</b></td>
                   <td><?php echo $total; ?> </td>
                 </tr>

                 <tr align="center">
                   <td colspan="2"><input type="submit" name="update_cart" value="Update Cart"/></td>
                   <td><input type="submit" name="continue" value="Continue Shopping"></td>
                   <td><a href="checkout.php" style="text-decoration:none; color:black;"><button>Checkout</a></button></td>
                 </tr>

              </table>


            </form>
           

              </div>

            </div>

        </div>
      <!-- Content Wrapper ends here-->


      <div id="footer">
            Footer
      </div>

    </div>

        <!-- main_wrapper ends here-->
  </body>

</html>
