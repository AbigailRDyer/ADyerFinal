<?php if ($_SESSION['isValidUser'] == false || $_SESSION['user_id'] <= 0 ) : ?>
    <p><a href="../index.php">Login</a></p>
<?php die('Access Denied '); endif;  ?>

