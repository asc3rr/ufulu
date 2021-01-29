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
    <h1 class="heading">Create Account</h1>
    <form action="../../backend/register.php" method="post">
        Nick: <input type="text" name="nick" placeholder="Nick">
        <br><br>
        Password: <input type="password" name="pass1" placeholder="Password">
        <br><br>
        Repeat password: <input type="password" name="pass2" placeholder="Repeat password">
        <br><br>
        <input type="submit" value="Create account">
    </form>
    <h4 class="heading"><a class="link" href="../login">Already have an account? Log in!</a></h4>
</body>
</html>

<?php
    if(isset($_GET['code'])){
        $code = $_GET['code'];

        if($code==403){
            echo <<<ENDL
            <script>
                alert("Registration failed");
            </script>
            ENDL;
        }
        else if($code == 400){
            echo <<<ENDL
            <script>
                alert("Not enough parameters");
            </script>
            ENDL;
        }
    }
?>