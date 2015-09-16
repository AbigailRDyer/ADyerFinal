<?php

function getAllPerUser () {
    $id = $_SESSION['currentUserID'];
    $db = getDatabase();
    $stmt = $db->prepare("SELECT * FROM address WHERE user_id = :user_id");
    $results = array(":id" => $id);
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return true;
    }
}

function getAllGroups () {
    $db = getDatabase();
    $stmt = $db->prepare("SELECT * FROM address_groups");
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
}

