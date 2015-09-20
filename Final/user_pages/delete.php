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

        $addressid = filter_input(INPUT_GET, 'id');

        $isDeleted = delete($addressid);
        $results = "";

        if (!$isDeleted) {
            $results = "Contact was NOT deleted";
        } else {
            $results = "Contact was deleted successfully";
        }
        ?>
    <center>
        <div class="text-success">
            <h1>Deleting Contact...</h1><br /></div>
        <?php include '../includes/results.html.php'; ?>

        <br /><br /><button class="btn btn-sm" onClick="location.href = '../includes/userlinks.php'">Back</button>
    </center>
</body>
</html>
