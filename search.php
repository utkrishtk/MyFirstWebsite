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
        #mycontainer{
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <?php 
   include 'partials/_dbconnect.php';
   ?>
    <?php
    include 'partials/_header.php';
   ?>

<!-- Search result -->
<div class="container my-3" id="mycontainer">
    <h1>Search results for <em>"<?php echo $_GET['search'] ?>"</em></h1>

<?php
$noresult =true;
$query =$_GET["search"];
$sql="SELECT * FROM threads WHERE MATCH(thread_title,thread_desc) against('$query')";
$result= mysqli_query($conn, $sql);
while($row=mysqli_fetch_assoc($result)){
    $title=$row["thread_title"];
    $desc=$row["thread_desc"];
    $thread_id=$row["thread_id"];
    $thread_user_id=$row["thread_user_id"];
    $sql2="select user_email from users where sno='$thread_user_id'";
    $result2=mysqli_query($conn, $sql2);
    $row2=mysqli_fetch_assoc($result2);
    $url = "thread.php?threadid=".$thread_id."&asked=".$row2['user_email'];
    $noresult=false;
    echo ' <div class="result">
            <h3><a href="'.$url.'" class="text-dark">'.$title.'</a></h3>
            <p>'.$desc.'</p>
             </div>';

    }
    if($noresult){
        echo '  <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No Results Found</p>
          <p class="lead">Suggestions:<ul>
  
         <li> Make sure that all words are spelled correctly.</li>
         <li>Try different keywords.</li>
         <li> Try more general keywords.</li>
            </ul>
          
          </p>
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