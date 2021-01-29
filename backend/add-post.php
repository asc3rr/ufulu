<?php
    session_start();

    if(!isset($_SESSION['nick'])){
        header("Location: login/");
    }

    if(!isset($_POST['content']) && empty($_POST['content'])){
        header("Location: ../");
        die;
    }

    $nick = $_SESSION['nick'];
    $content = $_POST['content'];

    require_once("db.php");

    $db = new DB();
    $db->add_post($nick, $content);

    header("Location: ../");
?>