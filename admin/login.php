<?php
include "../components/connect.php";

if(isset($_COOKIE['tutor_id'])){
    $tutor_id = $_COOKIE['tutor_id'];
}else{
    $tutor_id = '';
}

if(isset($_POST['submit'])){
    
    $email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
    $pass = $_POST['pass'];
    $verify_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE email =? LIMIT 1");
    $verify_tutor->execute([$email]);
    
    if($verify_tutor->rowCount()>0){
        $row= $verify_tutor->fetch(PDO::FETCH_ASSOC);
        if(password_verify($pass,$row['password'])){
        setcookie('tutor_id',$row['id'],time()+ 60*60*24*30,'/');
        header('location:dashboard.php');
        exit;
     }else{
        $message[] = "incorrect password!";
        }               
    }
    else{
        $message[] = "incorrect email!";
    }

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

<!-- font awesome cdn link -->
 <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!-- custom CSS file link -->
 <link rel = "stylesheet" href = "../css/admin_style.css">

</head>
<body style="padding-left:0;">
    
<?php
if(isset($message)){
    foreach($message as $message){
        echo '
        <div class="message form">
        <span>'.$message.'</span>
        <i class = "fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>
    
<!--register section starts -->

<section class="form-container">
    <form action="" class="login" method="post" enctype="multipart/form-data">
        <h3>welcome back! </h3>       
            <p>your email <span>*</span></p>
            <input type="email" name="email" maxlength="50" required placeholder="enter your email" class="box">
            </div>
            <div class="col">
            <p>your password <span>*</span></p>
            <input type="password" name="pass" maxlength="20" required placeholder="enter your password" class="box">
        <input type="submit" value="login now" name="submit" class="btn">
        <p class="link">dont't have an account? <a href="register.php">register new</a></p>
    </form>
</section>

<!-- register section ends -->




<!-- custom Javascript file link -->
<script src = "../js/admin_script.js" ></script>

</body>
</html>
