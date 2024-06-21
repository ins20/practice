<?php
require './instance.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estimate = $_POST['estimate'];
    $id = $_POST['id'];

    $sql = "UPDATE `order` SET `estimate`='$estimate' WHERE `id`='$id'";

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