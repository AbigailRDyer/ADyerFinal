<?php $group = getAllGroups(); ?>

<form method="post" action="#" >
            Sort By:
            <select name="address_group_id" required>
                <?php foreach ($group as $row): ?>
                    <option value="<?php echo $row['address_group_id']; ?>">
                        <?php echo $row['address_group']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br /><br /><input type="text" name="searchtext" value="" />
            <input class="btn btn-success" type="submit" value="Search" />
                                 
</form>

