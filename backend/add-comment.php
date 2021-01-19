<?php
    session_start();

    if(!isset($_SESSION['nick'])){
        header("Location: ../user/login/");
    }

    $nick = $_SESSION['nick'];
    $post_id = $_POST['post_id'];
    $content = $_POST['content'];

    require_once("db.php");

    $db = new DB();
    $db->add_comment($nick, $post_id, $content);

    header("Location: ../post/view/?id=$post_id");
?>