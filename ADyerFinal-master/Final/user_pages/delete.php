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
        include_once '../includes/access-required.html.php';
        include '../functions/addressBookFunctions.php';
        include_once '../functions/dbConn.php';
        include '../functions/until.php';
        include '../functions/loginFunction.php';
        
//prior to this page, the user is prompted with a message box if they are sure they want to delete the selected entry        
//pulls the address_id from the selected entry on view page
        $addressid = filter_input(INPUT_GET, 'id');

//uses delete function which returns a bool
        $isDeleted = delete($addressid);
        $results = "";
        
//notifies the user if the contact was deleted
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
