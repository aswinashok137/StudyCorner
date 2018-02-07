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
            <li> <a href="all_products.php">All Books</a></li>
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

               <div id="shopping_cart">

                  <span style="float:right; font-size:18px; padding:5px; line-height:40px;">
                    Welcome Guest! <b style="color:yellow"> Shopping Cart </b> Total Items: Total Price:
                    <a href="cart.php" style="color:yellow">Go to Cart</a>
                  </span>
              </div>

              <div id="books_box">
                <?php
                if (isset($_GET['search'])) {

                $search_query=$_GET['user_query'];

                $get_book="select * from books where book_keywords like '%$search_query%'";

                $run_book=mysqli_query($con,$get_book);

                while($row_book=mysqli_fetch_array($run_book)) {
                  $book_id=$row_book['book_id'];
                  $book_branch=$row_book['book_branch'];
                  $book_sem=$row_book['book_sem'];
                  $book_title=$row_book['book_title'];
                  $book_price=$row_book['book_price'];
                  $book_image=$row_book['book_image'];

                  echo "

                   <div id='single_book'>
                    <h3>$book_title</h3>
                    <img src='admin_area/book_images/$book_image' width='180px' height='180'/>
                    <p><b> $book_price</b></p>
                    <a href='details.php?book_id=$book_id' style='float:left;'>Details</a>
                    <a href='index.php?book_id=$book_id'><button style='float:right;'>Add to Cart</button></a>
                  </div>

                  ";
                }
              }
                 ?>
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
