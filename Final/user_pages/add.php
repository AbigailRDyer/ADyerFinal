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
        
        $group = getAllGroups();
        
        if ( isPostRequest() ) {
            $userid = $_SESSION['currentUserID'];
            $group = filter_input(INPUT_POST, 'address_group_id');
            $fullname = filter_input(INPUT_POST, 'fullname');
            $email = filter_input(INPUT_POST, 'email');
            $address = filter_input(INPUT_POST, 'address');
            $phoneEntry = filter_input(INPUT_POST, 'phone');
            $website = filter_input(INPUT_POST, 'website');
            $birthday = filter_input(INPUT_POST, 'birthday');
            $image = uploadImage();
            
            $errors = array();
            
            $phone = justNumbersPhone($phoneEntry);
            
            if(!validPhone($phone))
            {
                $errors[] = 'Phone is not valid';
            }
            
            if(false === $image) {
                $errors[] = 'image could not be uploaded';
            }
            
            if(count($errors) == 0) {
                if(addEntry($userid, $group, $fullname, $email, $address, $phone, $website, $birthday, $image)){
                $results = 'New entry was successfully added to your address book';
                } else {
                    $results = 'New entry was not added, try again';
                }
            }
        }
        ?>
        
    <center>
        <h1>Add New Entry</h1><br />

        <?php if (isset($errors) && count($errors) > 0) : ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        
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
        
        <?php include '../includes/results.html.php'; ?>
        
        <br /><br />
        <button class="btn btn-sm" onClick="location.href = '../includes/userlinks.php'">Back</button><br /><br />
    </center>
    </body>
</html>
