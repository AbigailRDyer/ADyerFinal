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

        $results = read($addressid);
        ?>

    <center>
        <div class="text-success">
            <h1>Viewing Contact</h1><br /></div>

        <ul class="list-group">
            <li class="list-group-item"><?php echo $results['fullname']; ?></li>
            <li class="list-group-item"><a href="http://maps.google.com/?q=<?php echo $results['address']; ?>" target="_blank"><?php echo $results['address']; ?></a></li>
            <li class="list-group-item"><a href="mailto:<?php echo $results['email']; ?>"><?php echo $results['email']; ?></a></li>
            <li class="list-group-item"><a href="tel:<?php echo $results['phone']; ?>"><?php echo $results['phone']; ?></a></li>
            <li class="list-group-item"><a href="<?php echo $results['website']; ?>" target="_blank"><?php echo $results['fullname']; ?>'s Website</a></li>
            <li class="list-group-item"><?php echo date("M jS, Y", strtotime($results['birthday'])); ?></li>
            <li class="list-group-item"><?php if (empty($results['image'])) : ?>
                    No Image Available
                <?php else: ?>
                    <img src="images/<?php echo $results['image']; ?>" height="150"  />
                <?php endif; ?></li>
        </ul>
        
        <button class="btn btn-default"><a href="update.php?id=<?php echo $addressid; ?>">Update</a></button>
        <a href="delete.php?id=<?php echo $row['address_id']; ?>" onclick="return confirm('Are you sure you want to delete <?php echo $results['fullname']; ?> ?')">Delete</a>
        
        <br /><br /><button class="btn btn-sm" onClick="location.href = '../includes/userlinks.php'">Back</button>
    </center>
</body>
</html>
