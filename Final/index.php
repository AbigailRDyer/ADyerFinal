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
        <div class="text-success">
            <h1>Address Book</h1></div>
        <h4>Your online contact organization buddy!</h4><br /><br />

        <?php
        if (isPostRequest()) {
            
//when user clicks submit on the login it pulls the email and password entered
            $email = filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');
            
//checks if entered login is a valid user
            if (isValidUser($email, $password)) {
                $_SESSION['isValidUser'] = true;
            } else {
                $results = 'Sorry please try again';
            }
        }
        if (isset($_SESSION['isValidUser']) && $_SESSION['isValidUser'] === true) {
            
//checks that the session variables are set and redirects the user to the userlinks
            header('Location: includes/userlinks.php');
            ?> <br /><br /> <?php
        } else {
            
//if the session variables are not yet set, the login form and create login are displayed
            include 'includes/loginform.html.php'; ?>
            <button class="btn btn-sm" onClick="location.href = 'createlogin.php'">Sign Up</button><br />It's easy and free!
            <?php
        }
        ?>
    </body>
</html>