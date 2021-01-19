<?php
    session_start();

    if(!isset($_SESSION['nick'])){
        header("Location: login/");
    }

    $nick = $_SESSION['nick'];
    $content = $_POST['content'];

    require_once("db.php");

    $db = new DB();
    $db->add_post($nick, $content);

    header("Location: ../");
?>