<?php
    session_start();

    if(!isset($_SESSION['nick'])){
        header("Location: ../../user/login/");
    }
    else if(!isset($_GET['id'])){
        header("../../");
    }

    $nick = $_SESSION['nick'];
    $id = $_GET['id'];

    require_once("../../backend/db.php");

    $db = new DB();
    $resp = $db->view_post($id);

    if($resp["code"] === 404){
        $content = "We didn't find post with this id :(";
    }
    else if($resp["code"] === 200){
        $content = $resp["content"];
        $author = $resp["author"];
        $date = $resp["date"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>View post - Ufulu</title>

    <link rel="stylesheet" href="../../css/sections.css">
    <link rel="stylesheet" href="../../css/comments.css">
    <link rel="stylesheet" href="../../css/buttons.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="../../css/logo.css">
    <link rel="stylesheet" href="../../css/font.css">
    <link rel="stylesheet" href="../../css/post.css">
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
                    <a class="button" href="user/profile/?nick=$nick">Your Profile</a>
                ENDL;
            ?>
            <a class="button" href="../../backend/logout.php">Logout</a>
        </div>
    </nav>
    <main>
        <div id="post-section">
            <span class="post-content">
                <?php
                    echo $content;
                ?>
            </span>
            <br><br>
            <span class="post-author">
                <?php
                    echo $author;
                ?>
            </span>
            <br>
            <span class="post-date">
                <?php
                    echo $date;
                ?>
            </span>
        </div>
        <div id="comments">
            <?php
                $resp = $db->get_comments($id);

                if($resp["code"] === 404){
                    echo "Comments not found :(";
                }
                else{
                    unset($resp["code"]);

                    foreach($resp as $post_data){
                        $content = $post_data["content"];
                        $author = $post_data["author"];

                        echo <<<ENDL
                            <div class="comment">
                                <span class="content">$content</span>
                                <br><br>
                                <span class="author">$author</span>
                            </div>
                        ENDL;
                    }
                }
            ?>
        </div>
    </main>
</body>
</html>