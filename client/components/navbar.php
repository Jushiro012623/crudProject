
    <div class="navbard">
        <a class="a" href="home.php"><?php echo strtoupper($_SESSION['username']);?></a>
        <ul class="nav-link-wrapper">
            <li class="nav-item">
                <i class="fa-solid fa-house"></i>
                <a class="nav-link" href="home.php" >Home</a>
            </li>
            <li class="nav-item">
                <i class="fa-solid fa-user"></i>
                <a class="nav-link active" aria-current="page" href="profile.php">Profile</a>
            </li>
            <li class="nav-item">
                <i class="fa-solid fa-user"></i>
                <a class="nav-link active" aria-current="page" href="arc.php">Archive</a>
            </li>
            <li class="nav-item">
                <i class="fa-solid fa-right-from-bracket"></i>
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li> -->
        </ul>
    </div>