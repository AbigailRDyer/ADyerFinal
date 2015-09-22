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
    $id = array();
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email and password = :password");
    $password = sha1($password);
    $binds = array(
        ":email" => $email,
        ":password" => $password
    );
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $id = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['currentUserID'] = $id[0]['user_id'];
        return true;
    }
    return false;
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