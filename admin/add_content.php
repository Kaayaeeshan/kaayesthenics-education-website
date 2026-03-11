<?php
include "../components/connect.php";

if(isset($_COOKIE['tutor_id'])){
    $tutor_id = $_COOKIE['tutor_id'];
}else{
    $tutor_id = '';
    //header('location:login.php');
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Content</title>

<!-- font awesome cdn link -->
 <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!-- custom CSS file link -->
 <link rel = "stylesheet" href = "../css/admin_style.css">

</head>
<body>
    
<!-- header section link -->
<?php include "../components/admin_header.php"; ?>




<!-- footer section link -->
 <?php include "../components/footer.php"; ?>

<!-- custom Javascript file link -->
<script src = "../js/admin_script.js" ></script>

</body>
</html>