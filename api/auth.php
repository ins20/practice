<?php
require './instance.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    try {
        $sql = "INSERT INTO `user`(`login`, `password`) VALUES ('$login','$password');";
        $res = $dbh->query($sql);
        $userId = $dbh->lastInsertId();
        setcookie("user_id", $userId);

        echo json_encode($res);
    } catch (PDOException $e) {
        echo $e->getMessage();
        http_response_code(400);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $login = $_GET['login'];
    $password = $_GET['password'];

    try {
        $sql = "SELECT * FROM user WHERE `login` = '$login' AND `password` = '$password'";
        $res = $dbh->query($sql);
        $data = $res->fetch(PDO::FETCH_ASSOC);
        setcookie("user_id", $data['id']);

        echo json_encode($data);
    } catch (PDOException $e) {
        echo $e->getMessage();
        http_response_code(400);
    }
}
?>