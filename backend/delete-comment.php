<?php
    session_start();

    if(!isset($_SESSION['nick'])){
        header("Location: ../user/login/");
    }

    $nick = $_SESSION['nick'];
    $post_id = $_GET["post_id"];
    $comment_id = $_GET['comment_id'];

    require_once("db.php");

    $db = new DB();
    $db->delete_comment($nick, $comment_id);

    header("Location: ../post/view/?id=$post_id");
?>
