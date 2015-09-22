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

//pulls the address_id from the view page        
        $addressid = filter_input(INPUT_GET, 'id');

//pulls all address groups        
        $group = getAllGroups();
        
//pulls the current entry data using the address_id        
        $contactInfo = read($addressid);

        if (isPostRequest()) {
            
//grabs all of the new entered data            
            $group = filter_input(INPUT_POST, 'address_group_id');
            $fullname = filter_input(INPUT_POST, 'fullname');
            $email = filter_input(INPUT_POST, 'email');
            $address = filter_input(INPUT_POST, 'address');
            $phoneEntry = filter_input(INPUT_POST, 'phone');
            $website = filter_input(INPUT_POST, 'website');
            $birthday = filter_input(INPUT_POST, 'birthday');

            $errors = array();

//removes everything but the numbers from the phone            
            $phone = justNumbersPhone($phoneEntry);

            if (!validPhone($phone)) {
//validates the phone number                
                $errors[] = 'Phone is not valid';
            }

            if (count($errors) == 0) {
//uploads the image, if no image was used it doesn't replace a previously uploaded image                
                $image = uploadImage();
                if ($image == NULL) {
                    updateNoImage($addressid, $group, $fullname, $email, $address, $phone, $website, $birthday);
                    $results = 'Contact was successfully updated without the image';
                } 
                else {
                    update($addressid, $group, $fullname, $email, $address, $phone, $website, $birthday, $image);
                    $results = 'Contact was successfully updated';
                }
            }
        }
        ?>

    <center>
        <div class="text-success">
            <h1>Update Contact</h1><br /></div>

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
                Full Name: <br /><input type="text" name="fullname" value="<?php echo $contactInfo['fullname']; ?>" required/> 
                <br /> 
                Email: <br /><input type="text" name="email" value="<?php echo $contactInfo['email']; ?>" required/>
                <br /> 
                Address: <br /><input type="text" name="address" value="<?php echo $contactInfo['address']; ?>" required/> 
                <br /> 
                Phone: <br /><input type="text" name="phone" value="<?php echo $contactInfo['phone']; ?>" required/> 
                <br /> 
                Website: <br /><input type="text" name="website" placeholder="http://" value="<?php echo $contactInfo['website']; ?>"/>
                <br /> 
                Birthday: <br /><input type="date" name="birthday" value="" required/>
                <br /><br />
                <label>Image Upload: </label>
                <input name="upfile" type="file">
            </div><br/>
            <input class="btn btn-success" type="submit" value="Update" />
        </form><br />

        <?php include '../includes/results.html.php'; ?>

        <br /><br />
        <button class="btn btn-sm" onClick="location.href = '../includes/userlinks.php'">Back</button><br /><br />
    </center>
    ?>
</body>
</html>
