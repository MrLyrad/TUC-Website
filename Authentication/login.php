<?php
    session_start();
    if (isset($_SESSION["user"])) {
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html>
    <?php
        if(isset($_POST["login"])){
            $email = $_POST["email"];
            $password = $_POST["password"];

            require_once "../db-connector.php";

            $sql = "SELECT * FROM volunteers WHERE email = '$email'";
            $result = mysqli_query($connection, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if(empty($password) OR empty($email)) {
                echo "<div>Please input Login details</div>";
            }
            
            if ($user) {
                if (password_verify($password, $user["password"])){
                    session_start();
                    $_SESSION["user"] = $user;
                    header("Location: ../index.php");
                    die();
            } else {
                    echo "<div>Password does not match</div><br />";
                }
            } else {
                echo "<div>Email does not match</div>";
            }
        }
    ?>

    <form action="login.php" method="post">
        <h1>Email</h1>
        <input type="email" id="email" name="email">
        <br />
        <h1>Password</h1>
        <input type="password" id="password" name="password">
        <br />
        <input type="submit" id="submit-button" name="login" value="login">
    </form>

    <br />
    <p>Not a volunteer yet?</p>
    <!-- Redirect to Registration -->
    <button onclick="window.location.href='signup.php';">Signup</button>

    <br />
    <button onclick="window.location.href='../index.php';">Return</button>
</html>