<?php $group = getAllGroups(); ?>

<form method="POST" action="#" >
            Sort By:
            <select name="addressGroupSort" required>
                <?php foreach ($group as $row): ?>
                    <option value="<?php echo $row['address_group_id']; ?>">
                        <?php echo $row['address_group']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br /><br /><input type="text" name="searchtext" value="" />
            <select>
                <option value="Fullname" name="fullname"></option>
                <option value="Address" name="address"></option>
                <option value="Address" name="address"></option>
            </select>
            <input class="btn btn-success" type="submit" value="Search" />
                                 
</form>

