<?php
    require_once("db.php");

    $nick = $_POST['nick'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    $db = new DB();

    $result = $db->register($nick, $pass1, $pass2);

    if($result){
        header("Location: ../user/login/?code=200");
    }
    else{
        header("Location: ../user/register/?code=403");
    }
?>