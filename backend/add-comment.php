<?php
    session_start();

    if(!isset($_SESSION['nick'])){
        header("Location: ../user/login/");
    }
    if(!isset($_POST["post_id"]) && empty($_POST["post_id"]) && !isset($_POST["content"]) && empty($_POST["content"])){
        header("Location: ../");
        die;
    }

    $nick = $_SESSION['nick'];
    $post_id = $_POST['post_id'];
    $content = $_POST['content'];

    require_once("db.php");

    $db = new DB();
    $db->add_comment($nick, $post_id, $content);

    header("Location: ../post/view/?id=$post_id");
?>