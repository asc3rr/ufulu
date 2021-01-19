<?php
    session_start();

    if(!isset($_SESSION['nick'])){
        header("Location: login/");
    }

    $nick = $_SESSION['nick'];

    require_once("../../backend/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Management - Ufulu</title>

    <meta charset="description" content="Privacy respecting socialmedia site.">

    <link rel="stylesheet" href="../../css/sections.css">
    <link rel="stylesheet" href="../../css/buttons.css">
    <link rel="stylesheet" href="../../css/profile.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="../../css/logo.css">
    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/font.css">
</head>
<body>
    <nav>
        <div id="logo-section">
            Ufulu - Because privacy matters.
        </div>
        <div id="buttons">
            <a class="button" href="../../index.php">Main</a>
            <?php
                echo <<<ENDL
                    <a class="button" href="../profile/?nick=$nick">Your Profile</a>
                ENDL;
            ?>
            <a class="button" href="../../backend/logout.php">Logout</a>
        </div>
    </nav>
    <main>
        <h1>Edit biogram</h1>
        <form action="../../backend/biogram.php" method="post" id="bio-form">
            <textarea name="bio"></textarea>
            <br><br>
            <input type="submit" value="Submit">
        </form>

        <h1>Edit password</h1>
        <form action="../../backend/password.php" method="post" id="password-form">
            Old password: <input type="password" name="old"><br><br>
            New password: <input type="password" name="pass1"><br><br>
            Repeat password: <input type="password" name="pass2"><br><br>
            <br>
            <input type="submit" value="Change password">
        </form>
    </main>
    <footer>
        <?php echo date("Y"); ?> All rights reserved for ufulu.com&copy
    </footer>
</body>
</html>