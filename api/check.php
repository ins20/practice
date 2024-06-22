<?php
require './instance.php';
if (isset($_COOKIE['user_id'])) {
    $id = $_COOKIE['user_id'];
    try {
        $sql = "SELECT * FROM user WHERE `id` = '$id'";
        $res = $dbh->query($sql);
        $data = $res->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data);
    } catch (PDOException $e) {
        echo $e->getMessage();
        http_response_code(400);
    }
} else {
    http_response_code(400);

}