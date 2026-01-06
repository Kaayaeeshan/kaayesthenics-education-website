<?php
include "../components/connect.php";

if(isset($_COOKIE['tutor_id'])){
    $tutor_id = $_COOKIE['tutor_id'];
}else{
    $tutor_id = '';
}

if(isset($_POST['submit'])){

    $id =create_unique_id();
    $name = filter_input(INPUT_POST,"name",FILTER_SANITIZE_SPECIAL_CHARS);
    $profession = filter_input(INPUT_POST,"profession",FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
    $pass = $_POST['pass'];
    $c_pass =$_POST['c_pass'];

    $image = basename($_FILES['image']['name']);
    $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $rename = create_unique_id().'.'.$ext;
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder = '../uploaded_files/'.$rename;

    $select_tutor_email = $conn->prepare("SELECT * FROM `tutors` WHERE email=?");
    $select_tutor_email->execute([$email]);
    if($select_tutor_email->rowCount()>0){
            $message[]='email already taken';
    }

    else{
        if($pass != $c_pass){
            $message[] = 'password not matched!';
        }
        else{

            $pass = password_hash($pass, PASSWORD_DEFAULT);

            if($image_size > 2000000){
                $message[] = "image size is too large!";
            }else{
            $insert_tutor = $conn -> prepare("INSERT INTO `tutors`(id,name,profession,email,password,image) VALUES(?,?,?,?,?,?) ");
            $insert_tutor -> execute([$id,$name,$profession,$email,$pass,$rename]);
            move_uploaded_file($image_tmp_name,$image_folder);
            setcookie('tutor_id',$id, time() + 60*60*24*30, '/');
            header('location:dashboard.php');
            }
        }
    }

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

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
    <form action="" method="post" enctype="multipart/form-data">
        <h3>register new</h3>
        <div class="flex">
            <div class="col">
            <p>your name <span>*</span></p>
            <input type="text" name="name" maxlength="50" required placeholder="enter your name" class="box">
            <p>your profession<span>*</span></p>
            <select name="profession" id="" class="box">
                <option value="" disabled selected>-- selelct your profession</option>
                <option value="developer">developer</option>
                <option value="designer">designer</option>
                <option value="musician">musician</option>
                <option value="biologist">biologist</option>
                <option value="teacher">teacher</option>
                <option value="engineer">engineer</option>
                <option value="lawyer">lawyer</option>
                <option value="accountant">accountant</option>
                <option value="doctor">doctor</option>
                <option value="journalist">journalist</option>
                <option value="photographer">photographer</option>
            </select>
            <p>your email <span>*</span></p>
            <input type="email" name="email" maxlength="50" required placeholder="enter your email" class="box">
            </div>
            <div class="col">
            <p>your password <span>*</span></p>
            <input type="password" name="pass" maxlength="20" required placeholder="enter your password" class="box">  
            <p>confirm password <span>*</span></p>
            <input type="password" name="c_pass" maxlength="20" required placeholder="confirm your password" class="box">
            <p>select pic<span>*</span></p>
            <input type="file" name="image" class="box" required accept="image/*">  
            </div>
        </div>
        <input type="submit" value="register now" name="submit" class="btn">
        <p class="link">already have an account? <a href="login.php">login now</a></p>
    </form>
</section>

<!-- register section ends -->




<!-- custom Javascript file link -->
<script src = "../js/admin_script.js" ></script>

</body>
</html>