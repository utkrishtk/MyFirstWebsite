<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>iDiscuss - Browse Categories</title>
    <style>
    #ques {
        min-height: 500px;
    }
    </style>
</head>

<body>
    <?php
    include 'partials/_header.php';
   ?>
    <?php 
   include 'partials/_dbconnect.php';
   ?>
    <?php
    $id = $_GET['catid'];
       $sql = "SELECT * FROM `categories` WHERE `category_id`=$id";
       $result = mysqli_query($conn, $sql);
       while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
       }
      
   ?>
   <!-- PHP for form submission   -->
    <?php 
    $showAlert = false;
    $method=$_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        //Insert into thread into db   
        $th_title =$_POST['title'];
        $th_desc = $_POST['desc'];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp())";
        $result= mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong>Your thread has been added Please wait for community to respond.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }
    ?>
    <!-- Category container starts here  -->
    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname;?> forum</h1>
            <p class="lead"><?php echo $catdesc;?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not PM users asking for help.
                Remain respectful of other members at all times. </p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
    <!-- this is form submission -->
    <div class="container">
        <h1 class="py-2">Start a Discussion</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="form-group">
                <label for="title">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Keep your title as short as possible.</small>
            </div>
            <div class="form-group">
                <label for="desc">Elaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
    <div class="container" id="ques">
        <h1 class="py-2">Browse Questions</h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE `thread_cat_id`=$id";
        $result = mysqli_query($conn, $sql);
        $noResult=true;
        while($row = mysqli_fetch_assoc($result)){
        $noResult=false;
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        echo '<div class="media my-3">
        <img src="img/userdefault.png" width="52px" class="mr-3" alt="...">
        <div class="media-body">
            <h5 class="mt-0"><a href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
            <p>'.$desc.'</p>
        </div>
    </div>'; 
       }
       if($noResult){
           echo '<div class="jumbotron jumbotron-fluid">
           <div class="container">
             <p class="display-4">No Threads Found</p>
             <p class="lead">Be the first person to ask a question.</p>
           </div>
         </div>';
       }
      
   ?>

        
    </div>
    <?php
    include 'partials/_footer.php';
   ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>

</html>