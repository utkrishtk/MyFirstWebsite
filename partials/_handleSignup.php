<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    include '_dbconnect.php';
    $user_email=$_POST['signupEmail'];
    $user_email=str_replace("<","&lt;",$user_email);
    $user_email=str_replace(">","&gt;",$user_email);
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupcPassword'];

    //Check whether this email exists in the
    $existSql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $showError = "Email already exists";
    }
    else{
        if($pass == $cpass){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = true;
                header("Location: /forum/index.php?signupsuccess=true");
                exit();
            }
        }else{
            $showError = "Password does not match.";
        }
    }
    header("Location: /forum/index.php?signupsuccess=false&error=$showError");

}


?>