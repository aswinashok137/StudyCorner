<?php

$con = mysqli_connect("localhost","root","","studycorner");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL".mysqli_connect_errno();
}

// getting the user IP address
 function getIp() {
   $ip = $_SERVER['REMOTE_ADDR'];

   if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
       $ip = $_SERVER['HTTP_CLIENT_IP'];
   } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
   }

   return $ip;
}

//shopping_cart
function cart(){
  if (isset($_GET['add_cart'])) {

    global $con;

    $ip=getIp();

    $book_id=$_GET['add_cart'];

    $check_book="select * from cart where ip_add='$ip'AND b_id='$book_id'";

    $run_check=mysqli_query($con,$check_book);

    if (mysqli_num_rows($run_check)>0) {
      echo "";
    }

  else {
    $insert_book="insert into cart(b_id,ip_add) values ('$book_id','$ip')";

    $run_book=mysqli_query($con,$insert_book);

      echo "<script>window.open('index.php','_self')</script>";
  }
}
}

//getting the total added  items

function total_iems(){
  if (isset($_GET['add_cart'])) {

    global $con;

    $ip=getIp();

    $get_items="select * from cart where ip_add='$ip'";

    $run_items=mysqli_query($con,$get_items);

    $count_items=mysqli_num_rows($run_items);
    }
    else {

        global $con;
      $ip=getIp();

      $get_items="select * from cart where ip_add='$ip'";

      $run_items=mysqli_query($con,$get_items);

      $count_items=mysqli_num_rows($run_items);
    }

    echo $count_items;
}
//getting the total price of the items in the cart

function total_price(){

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

      $values=array_sum($book_price);

      $total +=$values;
    }
  }

  echo $total;

}



//getting the branches

function getBranch(){

  global $con;

  $get_branch="select * from branch";

  $run_branch=mysqli_query($con,$get_branch);

  while ($row_branch=mysqli_fetch_array($run_branch)) {

    $branch_id=$row_branch['branch_id'];
    $branch_title=$row_branch['branch_title'];

    echo "<li><a href='index.php?branch=$branch_id'>$branch_title</a></li>";
  }
}

function getSem(){

  global $con;

  $get_sem="select * from sem";

  $run_sem=mysqli_query($con,$get_sem);

  while ($row_sem=mysqli_fetch_array($run_sem)) {

    $sem_id=$row_sem['sem_id'];
    $sem_title=$row_sem['sem_title'];

    echo "<li><a href='index.php?sem=$sem_id'>$sem_title</a></li>";
  }
}

function getBook()
{

  if (!isset($_GET['branch'])) {
    if (!isset($_GET['sem'])) {

  global $con;

  $get_book="select * from books order by RAND() LIMIT 0,6 ";

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
      <p><b> Price: &#8377 $book_price</b></p>
      <a href='details.php?book_id=$book_id' style='float:left;'>Details</a>
      <a href='index.php?add_cart=$book_id'><button style='float:right;'>Add to Cart</button></a>
    </div>

    ";
  }
}
}
}

function getBranchBook()
{

  if (isset($_GET['branch'])) {

    $branch_id=$_GET['branch'];

  global $con;

  $get_branch_book="select * from books where book_branch='$branch_id'";

  $run_branch_book=mysqli_query($con,$get_branch_book);

  $count_branch=mysqli_num_rows($run_branch_book);

  if($count_branch==0){
     echo "<h2 style='padding:100px;'>There is no Book in this Branch!</h2>";
  }

  while($row_branch_book=mysqli_fetch_array($run_branch_book)) {

    $book_id=$row_branch_book['book_id'];
    $book_branch=$row_branch_book['book_branch'];
    $book_sem=$row_branch_book['book_sem'];
    $book_title=$row_branch_book['book_title'];
    $book_price=$row_branch_book['book_price'];
    $book_image=$row_branch_book['book_image'];

    echo "

     <div id='single_book'>
      <h3>$book_title</h3>
      <img src='admin_area/book_images/$book_image' width='180px' height='180'/>
      <p><b> Price: &#8377 $book_price</b></p>
      <a href='details.php?book_id=$book_id' style='float:left;'>Details</a>
      <a href='index.php?book_id=$book_id'><button style='float:right;'>Add to Cart</button></a>
    </div>

    ";
  }
}
}

function getSemBook()
{

  if (isset($_GET['sem'])) {

    $sem_id=$_GET['sem'];

  global $con;

  $get_sem_book="select * from books where book_sem='$sem_id'";

  $run_sem_book=mysqli_query($con,$get_sem_book);

  $count_sem=mysqli_num_rows($run_sem_book);

  if($count_sem==0){
     echo "<h2 style='padding:100px;'>There is no Book in this Semester!</h2>";
  }

  while($row_sem_book=mysqli_fetch_array($run_sem_book)) {

    $book_id=$row_sem_book['book_id'];
    $book_branch=$row_sem_book['book_branch'];
    $book_sem=$row_sem_book['book_sem'];
    $book_title=$row_sem_book['book_title'];
    $book_price=$row_sem_book['book_price'];
    $book_image=$row_sem_book['book_image'];

    echo "

     <div id='single_book'>
      <h3>$book_title</h3>
      <img src='admin_area/book_images/$book_image' width='180px' height='180'/>
      <p><b> Price: &#8377 $book_price</b></p>
      <a href='details.php?book_id=$book_id' style='float:left;'>Details</a>
      <a href='index.php?book_id=$book_id'><button style='float:right;'>Add to Cart</button></a>
    </div>

    ";
  }
}
}







 ?>
