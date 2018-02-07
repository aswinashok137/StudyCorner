<!DOCTYPE>
<?php
  include("includes/db.php");

 ?>
<html>
  <head>
    <title>Inserting Books</title>

  
  </head>

<body bgcolor="skyblue">

  <form class="" action="insert_books.php" method="post" enctype="multipart/form-data">
    <table align="center" width="750" border="2" bgcolor="orange">
      <tr align="center">
        <td colspan="8"><h2>Insert New Books Here</h2></td>
      </tr>

      <tr>
        <td align="right">Book Title</td>
        <td><input type="text" name="book_title" size="60" required/></td>
      </tr>

      <tr>
        <td align="right">Book Branch</td>
        <td>  <select name="book_branch">
            <option size=>Select a Branch</option>
            <?php
              $get_branch="select * from branch";

              $run_branch=mysqli_query($con,$get_branch);

              while ($row_branch=mysqli_fetch_array($run_branch)) {

              $branch_id=$row_branch['branch_id'];
              $branch_title=$row_branch['branch_title'];

              echo "<option value='$branch_id'>$branch_title</option>";
            }

             ?>
          </select></td>
      </tr>

      <tr>
        <td align="right">Book Semester</td>
        <td>
          <select name="book_sem">
            <option>Select a Semester</option>
            <?php

            $get_sem="select * from sem";

            $run_sem=mysqli_query($con,$get_sem);

            while ($row_sem=mysqli_fetch_array($run_sem)) {

              $sem_id=$row_sem['sem_id'];
              $sem_title=$row_sem['sem_title'];

              echo "<option value='$sem_id'>$sem_title</option>";
            }

             ?>
          </select>
        </td>
      </tr>

      <tr>
        <td align="right">Book Image</td>
        <td><input type="file" name="book_image" /></td>
      </tr>

      <tr>
        <td align="right">Book Price</td>
        <td><input type="text" name="book_price"size="60"/></td>
      </tr>

      <tr>
        <td align="right">Book Description</td>
        <td><textarea name="book_desc" cols="20" rows="10"></textarea></td>
      </tr>

      <tr>
        <td align="right">Book Keywords</td>
        <td><input type="text" name="book_keywords"/></td>
      </tr>

      <tr align="center">
        <td><input type="submit" name="insert_book" value="Insert Now"/></td>
      </tr>

    </table>
  </form>
</body>
</html>

<?php
  if (isset($_POST['insert_book'])) {
      //getting text data from the fields
      $book_title=$_POST['book_title'];
      $book_branch=$_POST['book_branch'];
      $book_sem=$_POST['book_sem'];
      $book_price=$_POST['book_price'];
      $book_desc=$_POST['book_desc'];
      $book_keywords=$_POST['book_keywords'];

      //getting image data from the fields
      $book_image=$_FILES['book_image']['name'];
      $book_image_tmp=$_FILES['book_image']['tmp_name'];

      move_uploaded_file($book_image_tmp,"book_images/$book_image");

      $insert_book ="insert into books(book_branch,book_sem,book_title,book_price,book_desc,book_image,book_keywords)
      values('$book_branch','$book_sem','$book_title','$book_price','$book_desc','$book_image','$book_keywords')";

      $insert_buk=mysqli_query($con,$insert_book);

      if ($insert_buk) {
        echo "<script>alert('Book has been inserted')</script>";
        echo "<script>window.open('insert_books.php','_self')</script>";
      }
  }

?>
