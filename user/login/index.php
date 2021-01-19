<?php
    session_start();

    if(isset($_SESSION['nick'])){
        header("Location: ../");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Login - Ufulu</title>

    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/font.css">
</head>
<body>
    <h1 class="heading">Login</h1>
    <form action="../../backend/login.php" method="post">
        Nick: <input type="text" name="nick" placeholder="Nick">
        <br><br>
        Password: <input type="password" name="password" placeholder="Password">
        <br>
        <br>
        <input type="submit" value="Log in">
    </form>
    <h4 class="heading"><a class="link" href="../register/">Don't have an account? Create one!</a></h4>
</body>
</html>

<?php
    if(isset($_GET['code'])){
        $code = $_GET['code'];

        if($code === 401){
            echo <<<ENDL
            <script>
                alert("Login failed");
            </script>
            ENDL;
        }
        else if($code === 200){
            echo <<<ENDL
            <script>
                alert("Account created. Log in");
            </script>
            ENDL;
        }
    }
?>