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
        include '../functions/loginFunction.php';
        
        ?>
    <center>
        <h1>Your Address Book</h1><br />
        <button class="btn btn-success" onClick="location.href = 'add.php'">Add New Entry</button>
        <br /><br />

        <?php
        $id = $_SESSION['currentUserID'];
        $results = getAllPerUser($id);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
        <?php 
        if ($results == NULL){
            echo "You have no contacts to display!";
        }
        else {
        foreach ($results as $row): ?>
                <tr>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><a href="read.php?id=<?php echo $row['address_id']; ?>">Read</a></td> 
                    <td><a href="update.php?id=<?php echo $row['address_id']; ?>">Update</a></td>            
                    <td><a href="delete.php?id=<?php echo $row['address_id']; ?>">Delete</a></td>            
                </tr>
            <?php endforeach; ?>
        </table>
<?php } ?>
        <br /><br /><button class="btn btn-sm" onClick="location.href = '../includes/userlinks.php'">Back</button>
    </center>
</body>
</html>
