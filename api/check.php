<?php
require './instance.php';
$id = $_COOKIE['user_id'];
try {
    $sql = "SELECT * FROM user WHERE `id` = '$id'";
    $res = $dbh->query($sql);
    $data = $res->fetch(PDO::FETCH_ASSOC);
    setcookie("user_id", $data['id'], time() + 20 * 24 * 60 * 60);
    echo json_encode($data);
} catch (PDOException $e) {
    echo $e->getMessage();
    http_response_code(400);
}