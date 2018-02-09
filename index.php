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

                    <?php getBranch(); ?>

                    </ul>

                    <div id="sidebar_title">Semester</div>
                      <ul id="branch">
                          <?php getSem(); ?>
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
                <?php getBook(); ?>
                <?php getBranchBook();?>
                <?php getSemBook(); ?>
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
