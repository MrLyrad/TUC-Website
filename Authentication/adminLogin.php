<?php
    session_start();
    if (isset($_SESSION["admin"])) {
        header("Location: ../adminHome.php");
    }
?>

<!DOCTYPE html>
<html>
    <h1>Admin Login</h1>
    <br />
    <?php
        if(isset($_POST["login"])){
            $email = $_POST["admin_email"];
            $password = $_POST["admin_password"];

            require_once "../db-connector.php";

            $sql = "SELECT * FROM admins WHERE admin_email = '$email'";
            $result = mysqli_query($connection, $sql);
            $admin = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if(empty($password) OR empty($email)) {
                echo "<div>Please input Login details</div>";
            }
            
            if ($admin) {
                if (password_verify($password, $admin["admin_password"])){
                    session_start();
                    $_SESSION["admin"] = $admin;
                    header("Location: ../admin/adminHome.php");
                    die();
            } else {
                    echo "<div>Password does not match</div><br />";
                }
            } else {
                echo "<div>Email does not match</div>";
            }
        }
    ?>

    <form action="adminLogin.php" method="post">
        <h1>Email</h1>
        <input type="email" id="admin_email" name="admin_email">
        <br />
        <h1>Password</h1>
        <input type="password" id="admin_password" name="admin_password">
        <br />
        <input type="submit" id="submit-button" name="login" value="login">
    </form>
    <br />
    <button onclick="window.location.href='../index.php';">Return</button>
</html>