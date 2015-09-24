<?php
/*
 * users
 * user_id
 * email
 * password
 */

//function to check if the entered username is valid
function isValidUser($email, $password) {
    $db = getDatabase();
    $results = array();
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email and password = :password");
    $password = sha1($password);
    $binds = array(
        ":email" => $email,
        ":password" => $password
    );
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return true;
    }
    return false;
}

function getUserID($email, $password) {
    $db = getDatabase();
    $id = 0;
    $results = array();
    $stuff = "";
    $stmt = $db->prepare("SELECT user_id FROM users WHERE email = :email and password = :password");
    $password = sha1($password);
    $binds = array(
        ":email" => $email,
        ":password" => $password
    );
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $results["user_id"];
    }
    return $id;
}

//function to create new username
function createUser($email, $password){
    $db = getDatabase();
    $stmt = $db->prepare("INSERT INTO users SET email = :email, password = :password, created = NOW()");
    $password = sha1($password);
    $binds = array(
        ":email" => $email,
        ":password" => $password
    );
    $stmt->execute($binds);
    
    if (empty($binds)) {
        return false;
    }
    return true;
}

//function to check the length of new password
function isValidPassword($password) {
    if (strlen($password) < 4) {
        return false;
    }
    return true;
}

//checks for email in database for creation
function checkEmail($email) {
    $db = getDatabase();
    $stmt2 = $db->prepare("Select * from users where email = :email");
    $binds = array(
        ":email" => $email
    );
    if ($stmt2->execute($binds) && $stmt2->rowCount() == 1) {
        return true;
    }
    return false;
}