<?php
require './instance.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $review = $_POST['review'];
    $id = $_POST['id'];

    $sql = "UPDATE `order` SET `review`='$review' WHERE `id`='$id'";

    $res = $dbh->query($sql);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM `order`, `user` where `review` IS NOT NULL AND `order`.`user_id` = `user`.`id`";
    $res = $dbh->query($sql);
    $data = $res->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
}

?>