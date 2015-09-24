<?php $group = getAllGroups();
//pulls all the address groups
?>

<form method="GET" action="#" >
            View By Group:
            <select name="addressGroupSort">
                <?php foreach ($group as $row): ?>
                    <option value="<?php echo $row['address_group_id']; ?>">
                        <?php echo $row['address_group']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input class="btn btn-sm" type="submit" value="Display" />
</form>
<form method="POST" action="#" >
            <br /><br /><input type="text" name="searchtext" value="" required/>
            <select name="searchBy" required>
                <option value="Fullname" name="fullname">Name</option>
                <option value="Address" name="address">Address</option>
                <option value="Email" name="email">Email</option>
                <option value="Phone" name="phone">Phone</option>
            </select>
            <input class="btn btn-sm" type="submit" value="Search" />
                                 
</form>

