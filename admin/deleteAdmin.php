<?php
    session_start();
    if (isset($_SESSION["admin"])) {
        $admin = $_SESSION["admin"];
        $admin_role = $admin["admin_role"];

        if($admin_role == "n_admin"){
          header("Location: adminHome.php");
        }
    } else {
      header("Location: ../authentication/adminLogin.php");
    }
?>
<?php
// Include database connection file
include '../db-connector.php';

    if (isset($_GET['id']))
    {
        $admin_id = $_GET['id'];

        //Prepare DELETE statement
        $removeAdmin = "DELETE FROM admins WHERE admin_id = :admin_id";

        //Execute statement
        $stmt = $pdo_obj->prepare($removeAdmin);
        $stmt->execute(['admin_id' => $admin_id]);

    // Check if deletion was successful
    if($stmt->rowCount() > 0) {
        // Redirect back to the page displaying all events
        echo 
        "
        <script>
        alert('Admin Deleted');
        </script>
        ";
        header("Location: allAdmin.php");
        exit();
    } 
    else 
    {
        echo "Failed to delete the admin.";
    }
    } 
    else 
    {
        echo "Invalid admin ID.";
    }

?>
