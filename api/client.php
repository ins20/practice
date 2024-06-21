<?php
require './instance.php';
$user_id = $_COOKIE['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    $photo_before = base64_encode(file_get_contents($_FILES['photo_before']['tmp_name']));

    $sql = "INSERT INTO `order`(`description`, `photo_before`, `user_id`) VALUES ('$description','$photo_before','$user_id')";

    $res = $dbh->query($sql);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM `order` WHERE `user_id` = '$user_id'";
    $res = $dbh->query($sql);
    $data = $res->fetchAll(PDO::FETCH_ASSOC);
    if ($data) {
        echo json_encode($data);
    } else {
        http_response_code(400);
    }
}
?>