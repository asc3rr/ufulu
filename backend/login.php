<?php
    require("db.php");

    $db = new DB();

    $nick = $_POST['nick'];
    $password = $_POST['password'];

    if($db->login($nick, $password)){
        session_start();

        $_SESSION['nick'] = $db->sanitize($nick);
        
        header("Location: ../");
    }
    else{
        header("Location: ../user/login/?code=401");
    }
?>