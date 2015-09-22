<?php

/* address_id
 * user_id
 * address_group_id   req
 * fullname   req
 * email   req
 * address   req
 * phone   req
 * website
 * birthday   req
 * image
 */

function getAllPerUser($id) {
    $db = getDatabase();
    $stmt = $db->prepare("SELECT * FROM address WHERE user_id = :user_id ORDER BY fullname ASC");
    $binds = array(":user_id" => $id);
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}

function read($addressid) {
    $db = getDatabase();
    $stmt = $db->prepare("SELECT * FROM address WHERE address_id = :address_id");
    $binds = array(":address_id" => $addressid);
    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        return $results;
    }
}

function delete($addressid) {
    $db = getDatabase();
    $stmt = $db->prepare("DELETE FROM address WHERE address_id = :address_id");
    $binds = array(":address_id" => $addressid);
    if ($stmt->execute($binds)) {
        return true;
    } else {
        return false;
    }
}

function update($addressid, $group, $fullname, $email, $address, $phone, $website, $birthday, $image) {
    $db = getDatabase();
    $stmt = $db->prepare("UPDATE address SET address_group_id = :address_group_id, fullname = :fullname, email = :email, address = :address, phone = :phone, website = :website, birthday = :birthday, image = :image WHERE address_id = :address_id");
    $binds = array(
        ":address_id" => $addressid,
        ":address_group_id" => $group,
        ":fullname" => $fullname,
        ":email" => $email,
        ":address" => $address,
        ":phone" => $phone,
        ":website" => $website,
        ":birthday" => $birthday,
        ":image" => $image);
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
function updateNoImage($addressid, $group, $fullname, $email, $address, $phone, $website, $birthday) {
    $db = getDatabase();
    $stmt = $db->prepare("UPDATE address SET address_group_id = :address_group_id, fullname = :fullname, email = :email, address = :address, phone = :phone, website = :website, birthday = :birthday WHERE address_id = :address_id");
    $binds = array(
        ":address_id" => $addressid,
        ":address_group_id" => $group,
        ":fullname" => $fullname,
        ":email" => $email,
        ":address" => $address,
        ":phone" => $phone,
        ":website" => $website,
        ":birthday" => $birthday);
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function getAllGroups() {
    $db = getDatabase();
    $stmt = $db->prepare("SELECT * FROM address_groups");
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $results;
}

function justNumbersPhone($phone) {
    $phone = preg_replace("/[^0-9]/", "", $phone);
    $phone = $phone;
    return $phone;
}

function validPhone($phone) {
    if ($phone > 1000000000 && $phone < 9999999999) {
        return true;
    } else {
        return false;
    }
}

function addEntry($userid, $group, $fullname, $email, $address, $phone, $website, $birthday, $image) {
    $db = getDatabase();
    $stmt = $db->prepare("INSERT INTO address SET user_id = :user_id, address_group_id = :address_group_id, fullname = :fullname, email = :email, address = :address, phone = :phone, website = :website, birthday = :birthday, image = :image ");
    $binds = array(
        ":user_id" => $userid,
        ":address_group_id" => $group,
        ":fullname" => $fullname,
        ":email" => $email,
        ":address" => $address,
        ":phone" => $phone,
        ":website" => $website,
        ":birthday" => $birthday,
        ":image" => $image);
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        return true;
    }
    return false;
}

function uploadImage() {

    $imageName = "";

    try {
        // Undefined | Multiple Files | $_FILES Corruption Attack
        // If this request falls under any of them, treat it invalid.
        if (!isset($_FILES['upfile']['error']) || is_array($_FILES['upfile']['error'])) {
            throw new RuntimeException('Invalid parameters.');
        }
        // Check $_FILES['upfile']['error'] value.
        switch ($_FILES['upfile']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('No file sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('Exceeded filesize limit.');
            default:
                throw new RuntimeException('Unknown errors.');
        }
        // You should also check filesize here.
        if ($_FILES['upfile']['size'] > 1000000) {
            throw new RuntimeException('Exceeded filesize limit.');
        }
        // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
        // Check MIME Type by yourself.
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $validExts = array(
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        );
        $ext = array_search($finfo->file($_FILES['upfile']['tmp_name']), $validExts, true);
        if (false === $ext) {
            throw new RuntimeException('Invalid file format.');
        }
        // You should name it uniquely.
        // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
        // On this example, obtain safe unique name from its binary data.
        $fileName = sha1_file($_FILES['upfile']['tmp_name']);
        $location = sprintf('../images/%s.%s', $fileName, $ext);
        if (!move_uploaded_file($_FILES['upfile']['tmp_name'], $location)) {
            throw new RuntimeException('Failed to move uploaded file.');
        }
        /* File is uploaded successfully. */
        $imageName = $fileName . '.' . $ext;
    } catch (RuntimeException $e) {
        /* There was an error */
    }

    return $imageName;
}
