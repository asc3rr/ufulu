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
    $result = $db->delete_comment($nick, $comment_id);

    if($result){
        header("Location: ../post/view/?id=$post_id&code=200");
    }
    else{
        header("Location: ../post/view/?id=$post_id&code=403");
    }
?>
