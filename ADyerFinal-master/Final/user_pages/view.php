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
        include '../functions/loginFunction.php';
        include '../functions/until.php';
        include '../functions/searchFunctions.php';
        include '../functions/sortFunctions.php';

        $id = $_SESSION['user_id'];
        
        $results = getAllPerUser($id);

        if (isPostRequest()) {
//stores the search text and sends it to the search function
            $searchText = filter_input(INPUT_POST, 'searchtext');
            $searchBy = filter_input(INPUT_POST, 'searchBy');

            $results = search($searchText, $searchBy, $id);
        }

        if ($results == NULL) {
//stores the sort entry and sends it to the sortBy function
            $addressGroupSort = filter_input(INPUT_GET, 'addressGroupSort');

            $results = sortBy($addressGroupSort, $id);
        }
        ?>
    <center>
        <div class="text-success">
            <h1>Your Address Book</h1><br /></div>

        <?php include '../includes/sortresults.php' ?>

        <br /><br />

        <?php
        if ($results == NULL) {
            echo "There are no contacts to display, try searching or add new contacts!";
        } else {
            ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <?php foreach ($results as $row): ?>
                        <tr>
                            <td><?php echo $row['fullname']; ?></td>
                            <td><a href="read.php?id=<?php echo $row['address_id']; ?>">Read</a></td>
                            <td><a href="update.php?id=<?php echo $row['address_id']; ?>">Update</a></td>
                            <td><a href="delete.php?id=<?php echo $row['address_id']; ?>" onclick="return confirm('Are you sure you want to delete <?php echo $results['fullname']; ?> ?')">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table></div>
        <?php } ?>
        <br /><br />
        <button class="btn btn-success" onClick="location.href = 'add.php'">Add New Contact</button><br /><br />
        <button class="btn btn-sm" onClick="location.href = '../includes/userlinks.php'">Back</button>
    </center>
</body>
</html>
