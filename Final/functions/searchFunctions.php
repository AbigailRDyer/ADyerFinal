<?php

function sortSearch($sort, $search, $id) {
    $db = getDatabase();
    $stmt = $db->prepare("SELECT * FROM address WHERE user_id = :user_id LIKE CONCAT(:search, '%')");
    $binds = array(":user_id" => $id,
        ":search" => $search
        );
    $results = array();
     if ($stmt->execute($binds) && $stmt->rowCount() > 0) 
    {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }  
    return $results;
}

function sortSearchBlank($sort, $id) {
    $db = getDatabase();
    $stmt = $db->prepare("SELECT * FROM address WHERE user_id = :user_id ");
    $binds = array(":user_id" => $id,
        ":search" => $search
        );
    $results = array();
     if ($stmt->execute($binds) && $stmt->rowCount() > 0) 
    {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }  
    return $results;
}