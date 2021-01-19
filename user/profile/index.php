<?php
    session_start();

    if(!isset($_SESSION['nick'])){
        header("Location: login/");
    }

    $nick = $_SESSION['nick'];

    require_once("../../backend/db.php");

    $db = new DB();

    $profile_data = $db->get_profile($_GET['nick']);

    $owner = false;

    if($profile_data["code"] == 200){
        $profile_nick = $profile_data["nick"];
        $bio = $profile_data["bio"];

        if($nick === $profile_nick){
            $owner = true;
        }
    }
    else{
        $nick = "";
        $bio = "User not found :(";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title><?php echo $nick; ?> - Ufulu</title>

    <meta charset="description" content="Privacy respecting socialmedia site.">

    <link rel="stylesheet" href="../../css/sections.css">
    <link rel="stylesheet" href="../../css/buttons.css">
    <link rel="stylesheet" href="../../css/profile.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="../../css/logo.css">
    <link rel="stylesheet" href="../../css/font.css">
</head>
<body>
    <nav>
        <div id="logo-section">
            Ufulu - Because privacy matters.
        </div>
        <div id="buttons">
            <a class="button" href="../../">Main</a>
            <a class="button" href="../backend/logout.php">Logout</a>
        </div>
    </nav>
    <main>
        <span class="user-nick"><?php echo $profile_nick; ?></span>
        <br><br>
        <span class="user-bio"><?php echo $bio; ?></span>
        <br><br><br>
        <?php
            if($owner){
                echo <<<ENDL
                    <a class="edit-profile" href="../management/">Edit profile</a>
                ENDL;
            }
        ?>
    </main>
</body>
</html>
<?php
    if($_GET['code'] == 200){
        echo <<<ENDL
        <script>
            alert("Password updated");
        </script>
        ENDL;
    }

    if($_GET['code'] == 403){
        echo <<<ENDL
        <script>
            alert("Passwords does not match");
        </script>
        ENDL;
    }
?>