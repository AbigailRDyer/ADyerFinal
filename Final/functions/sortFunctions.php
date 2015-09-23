<?php

//function to view data by the selected address group for the current user
function sortBy($sort, $id) {
    $db = getDatabase();
    $stmt = $db->prepare("SELECT * FROM address WHERE address.user_id = :user_id AND address_group_id = :address_group_id ORDER BY address_group_id DESC");
    $binds = array(":user_id" => $id,
        ":address_group_id" => $sort
    );
    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
}

