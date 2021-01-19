<?php
    session_start();

    if(!isset($_SESSION['nick'])){
        header("Location: ../../user/login/");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    
    <title>Create post - Ufulu</title>

    <meta charset="description" content="Privacy respecting socialmedia site.">

    <link rel="stylesheet" href="../../css/sections.css">
    <link rel="stylesheet" href="../../css/buttons.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="../../css/logo.css">
    <link rel="stylesheet" href="../../css/font.css">
    <link rel="stylesheet" href="../../css/form.css">
</head>
<body>
    <nav>
        <div id="logo-section">
            Ufulu - Because privacy matters.
        </div>
        <div id="buttons">
            <a class="button" href="index.php">Main</a>
            <?php
                echo <<<ENDL
                    <a class="button" href="user/profile/?nick=$nick">Your Profile</a>
                ENDL;
            ?>
            <a class="button" href="backend/logout.php">Logout</a>
        </div>
    </nav>
    <main>
        <form action="../../backend/add-post.php" method="post">
            <textarea name="content"></textarea>
            <br><br>
            <input type="submit" value="Create post">
        </form>
    </main>
</body>
</html>