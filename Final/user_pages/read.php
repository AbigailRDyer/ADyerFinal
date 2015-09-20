<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
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
        
        $results = read($addressid);
        ?>
        
         <center>
        <h1>Viewing Contact</h1><br />
        
        <table class="table">
            <thead>
            </thead>
        
            <td><b>Name</b></td>
            <td><b>Address</b></td>
            <td><b>Email</b></td>
            <td> </td>
                <tr>
                    <td><?php echo $results['fullname']; ?></td>
                    <td><a href="http://maps.google.com/?q=<?php echo $results['address']; ?>" target="_blank"><?php echo $results['address']; ?></a></td>
                </tr>
                
        </table>
         </center>
    </body>
</html>
