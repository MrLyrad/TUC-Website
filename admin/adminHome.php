<?php
    session_start();
    if (!isset($_SESSION["admin"])) {
        header("Location: ../authentication/adminLogin.php");
    }  else {
        $admin = $_SESSION["admin"];
        $admin_fullname = $admin["admin_fullname"];
        $admin_email = $admin["admin_email"];
    }
?>
<!DOCTYPE html>
<html>
    <h1>Welcome Admin!</h1>
    <?php
        echo "<h1><b>".$admin_fullname."</b></h1>";
    ?>
    <br />
    <button onclick="window.location.href='contentDashboard.php';">Content Dashboard</button>
    <button onclick="window.location.href='addAdmin.php';">Register an Admin</button>
    <button onclick="window.location.href='../authentication/logout.php';">Logout</button>
</html>