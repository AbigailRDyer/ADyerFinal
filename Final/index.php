<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <title></title>
    </head>
    <body>
        <?php
        include_once 'functions/dbConn.php';
        include_once 'functions/loginFunction.php';
        include_once 'functions/until.php';
        require_once 'includes/session-start.php';
        ?>
    <center>
        <h1>Address Book</h1><br />

        <?php
        if (isPostRequest()) {
            $email = filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');
            if (isValidUser($email, $password)) {
                $_SESSION['isValidUser'] = true;
            } else {
                $results = 'Sorry please try again';
            }
        }
        if (isset($_SESSION['isValidUser']) && $_SESSION['isValidUser'] === true) {
            header('Location: includes/userlinks.php');
            ?> <br /><br /> <?php
        } else {
            include 'includes/loginform.html.php'; ?>
            <button class="btn btn-sm" onClick="location.href = 'createlogin.php'">Sign Up</button>
            <?php
        }
        ?>
    </body>
</html>