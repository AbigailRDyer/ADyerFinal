<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
        <title></title>
    </head>
    <body>
        <?php
        require_once '../includes/session-start.php';
        include '../functions/addressBookFunctions.php';
        include_once '../functions/dbConn.php';
        include '../functions/until.php';
        include '../functions/loginFunction.php';
        ?>
    <center>
        <div class="text-success">
            <h1>Welcome Back</h1><br /></div>
        <button class="btn btn-default" onClick="location.href = '../user_pages/view.php'">View Your Address Book</button>
        <button class="btn btn-default" onClick="location.href = '../user_pages/add.php'">Add New Contact</button>
        <br /><br />
        <a href="../includes/logout.php">Logout</a>

    </center>
</body>
</html>