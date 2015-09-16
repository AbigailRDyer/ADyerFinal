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
        
        $group = getAllGroups();
        ?>
    <center>
        <h1>Add New Entry</h1><br />

        <form method="post" action="#" enctype="multipart/form-data">
            Group:
            <select name="address_group_id" required>
                <?php foreach ($group as $row): ?>
                    <option value="<?php echo $row['address_group_id']; ?>">
                        <?php echo $row['address_group']; ?>
                    </option>
                <?php endforeach; ?>
            </select><br /><br /><div class="form-group">  
                Full Name: <br /><input type="text" name="fullname" value="" required/> 
                <br /> 
                Email: <br /><input type="text" name="email" value="" required/>
                <br /> 
                Address: <br /><input type="text" name="address" value="" required/> 
                <br /> 
                Phone: <br /><input type="text" name="phone" value="" required/> 
                <br /> 
                Website: <br /><input type="text" name="website" placeholder="http://" value=""/>
                <br /> 
                Birthday: <br /><input type="date" name="birthday" value="" required/>
                <br /><br />
                <label>Image Upload: </label>
                <input name="upfile" type="file">
            </div><br/>
            <input class="btn btn-success" type="submit" value="Submit" />
        </form><br />
        
        <br /><br />
        <button class="btn btn-sm" onClick="location.href = '../includes/userlinks.php'">Back</button>
    </center>
    </body>
</html>
