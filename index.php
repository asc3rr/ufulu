<?php
    session_start();

    if(!isset($_SESSION['nick'])){
        header("Location: user/login/");
    }
    
    $nick = $_SESSION['nick'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Main - Ufulu</title>

    <meta charset="description" content="Privacy respecting socialmedia site.">

    <link rel="stylesheet" href="css/sections.css">
    <link rel="stylesheet" href="css/buttons.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/logo.css">
    <link rel="stylesheet" href="css/font.css">
    <link rel="stylesheet" href="css/post.css">
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
            <a class="button" href="post/create">Create post</a>
            <a class="button" href="backend/logout.php">Logout</a>
        </div>
    </nav>
    <main>
        <?php
            require_once("backend/db.php");

            $db = new DB();

            $resp = $db->get_posts();

            if($resp["code"] === 404){
                echo "We didn't find any posts for you :(";
            }
            else if($resp["code"] === 200){
                unset($resp["code"]);

                foreach($resp as $post_data){
                    $id = $post_data["id"];
                    $content = $post_data["content"];
                    $author = $post_data["author"];
                    $date = $post_data["date"];

                    $content = substr($content, 0, 100);

                    if($nick === $author){
                        echo <<<ENDL
                        <article class="post">
                            <a class="profile-link" href="user/profile/?nick=$author">
                                <span class="post-author">$author</span>
                            </a>
                            <a class="remove-button" href="backend/delete-post.php?post_id=$id">Delete</a>
                            <br>
                            <span class="post-date">$date</span>
                            <br>
                            <span class="post-content">
                                $content
                            </span>
                            <span class="comments">
                                <a class="link" href="post/view/?id=$id">View post</a>
                            </span>
                        </article>
                        ENDL;
                    }
                    else{
                        echo <<<ENDL
                        <article class="post">
                            <a class="profile-link" href="user/profile/?nick=$author">
                                <span class="post-author">$author</span>
                            </a>
                            <br>
                            <span class="post-date">$date</span>
                            <br>
                            <span class="post-content">
                                $content
                            </span>
                            <span class="comments">
                                <a class="link" href="post/view/?id=$id">View post</a>
                            </span>
                        </article>
                        ENDL;
                    }
                }
            }
            else{
                echo "An unexpected error occurred :(";
            }
        ?>
    </main>
    <footer>
        <?php echo date("Y"); ?> All rights reserved for ufulu.com&copy
    </footer>
</body>
</html>