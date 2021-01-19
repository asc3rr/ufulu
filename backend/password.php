<?php
    session_start();

    if(!isset($_SESSION['nick'])){
        header("Location: login/");
    }

    require_once("db.php");

    $nick = $_SESSION['nick'];

    $old_pass = $_POST['old'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    $db = new DB();

    $result = $db->update_password($nick, $old_pass, $pass1, $pass2);

    if($result){
        header("Location: ../user/profile/?nick=$nick&code=200");
    }
    else{
        header("Location: ../user/profile/?nick=$nick&code=403");
    }
?>