<?php

//function to search address table for data matching entered search text by the selected column of the current user
function search($search, $by, $id) {
    $db = getDatabase();
    $stmt = $db->prepare("SELECT * FROM address WHERE user_id = :user_id AND $by LIKE CONCAT(:search, '%')");
    $binds = array(":user_id" => $id,
        ":search" => $search
    );
    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
}
