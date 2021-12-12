<?php
    echo '
        <nav>
            <a href="./" class="nav-item">Home</a>
    ';

    if (isset($_SESSION['email'])) {
        echo '<a href="./favourite.php" class="nav-item">My Favourite</a>';
        echo '<a href="./profile.php" class="nav-item">My Profile</a>';
        echo '<a href="./logout.php" class="nav-item">Log Out</a>';
    } else {
        echo '<a href="./login.php" class="nav-item id="login">Log In</a>';
    }
    echo '</nav>';
?>

<a href="../login/login.php">Log In</a>