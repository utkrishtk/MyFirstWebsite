<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $email=str_replace("<","&lt;",$email);
    $email=str_replace(">","&gt;",$email);
    $pass = $_POST['loginPass'];


    $sql ="SELECT * FROM users WHERE user_email='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
if($numRows==1){
    $row = mysqli_fetch_assoc($result);
    if(password_verify($pass,$row['user_pass'])){
        session_start();
        $_SESSION['loggedin']= true;
        $_SESSION['useremail']= $email;
        $_SESSION['sno']=$row['sno'];
        header("Location: /forum/index.php?login=true");
        exit();
    }else{
        $showerror="Password is Wrong.";
    }   
}else{
$showerror="Email not exist Please signup to login.";
}
header("Location: /forum/index.php?login=false&error=$showerror");
}
?>