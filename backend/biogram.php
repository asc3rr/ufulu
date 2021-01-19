<?php
    session_start();

    if(!isset($_SESSION['nick'])){
        header("Location: login/");
    }

    require_once("db.php");

    $nick = $_SESSION['nick'];

    $biogram = $_POST['bio'];

    $db = new DB();

    $db->update_biogram($nick, $biogram);

    header("Location: ../user/profile/?nick=$nick?code=200");
?>