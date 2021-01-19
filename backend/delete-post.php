<?php
    session_start();

    if(!isset($_SESSION['nick'])){
        header("Location: ../user/login/");
    }

    $nick = $_SESSION['nick'];
    $post_id = $_GET['post_id'];

    require_once("db.php");
    
    $db = new DB();
    $db->delete_post($nick, $post_id);

    header("Location: ../");
?>