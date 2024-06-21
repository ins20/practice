<?php
require './instance.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $photo_after = base64_encode(file_get_contents($_FILES['photo_after']['tmp_name']));
    $id = $_POST['id'];

    $sql = "UPDATE `order` SET `photo_after`='$photo_after' WHERE `id`='$id'";

    $res = $dbh->query($sql);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM `order`";
    $res = $dbh->query($sql);
    $data = $res->fetchAll(PDO::FETCH_ASSOC);
    if ($data) {
        echo json_encode($data);
    } else {
        http_response_code(400);
    }
}
?>