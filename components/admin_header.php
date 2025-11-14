<!-- header section starts -->
 
<header class="header">

    <section class="flex">
        <a href="dashboard.php" class="logo">Admin.</a>

        <form action="search_page.php" method="post" class="search-form">
            <input type="text" placeholder= "search here...." required maxlength="100" name= "search_box"/>
            <button type= "submit" class="fas fa-search" name= "search" ></button>
        </form>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="search-btn" class="fas fa-search"></div>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="user-toggle" class="fas fa-sun" ></div>
        </div>

        <div class="profile">
            <?php
                $select_profile = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
                $select_profile->execute([$user_id]);
                if($select_profile->rowCount() > 0){
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
               
            ?>
            <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
            <h3><?=$fetch_profile['name']; ?></h3>
            <span><?=$fetch_profile['profession']; ?></span>
            <a href="profile.php" class="btn"> view profile </a>
            <div class="flex-btn">
                <a href="login.php" class="option-btn">login</a>
                <a href="register.php" class="option-btn">register</a>
            </div>
            <a href="../components/admin_logout.php" onclick ="return confirm('logout from this website');" class="delete-btn">logout</a>
            <?php
             }else{
            ?>
            <h3 > please login first </h3>
            <div class="flex-btn">
                <a href="login.php" class="option-btn">login</a>
                <a href="register.php" class="option-btn">register</a>
            </div>
            <?php
             }
            ?>
        </div>

    </section>

</header>


<!-- header section ends -->