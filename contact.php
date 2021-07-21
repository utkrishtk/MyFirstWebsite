<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>iDiscuss - Browse Categories</title>
  </head>
  <body>
  <?php 
   include 'partials/_dbconnect.php';
   ?>
   <?php
    include 'partials/_header.php';
   ?>
   <?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $concern_email=$_POST['concern_email'];
      $concern_detail=$_POST['concern_detail'];
      $sql="INSERT INTO `contactus` ( `concern_email`, `concern_detail`, `concern_time`) VALUES ( '$concern_email', '$concern_detail', current_timestamp())";
      $result=mysqli_query($conn, $sql);
      if($result){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your concern has been submited. We will reach to you ASAP.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
    }

  ?>
  <div class="container my-3" style="min-height:79.3vh;">
    <h1 class="text-center">Contact Us</h1>
  <form action="\forum\contact.php" method="post">
  <div class="form-group">
    <label for="concern_email">Email address</label>
    <input type="email" class="form-control" id="concern_email" name="concern_email" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="concern_detail">Your Concern</label>
    <textarea class="form-control" id="concern_detail" name="concern_detail" rows="8"></textarea>
  </div>
  <button type="submit" class="btn btn-success">Submit</button>
</form>

  </div>
    <?php
    include 'partials/_footer.php';
   ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
  </body>
</html>