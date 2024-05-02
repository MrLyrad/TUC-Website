<?php
// Start the session
session_start();

// Ensure an admin is logged in
if (!isset($_SESSION["admin"])) {
    header("Location: ../authentication/adminLogin.php");
    exit();
}

// Check admin role and redirect if necessary
$admin = $_SESSION["admin"];
$admin_role = $admin["admin_role"];

if ($admin_role == "n_admin") {
    header("Location: adminHome.php");
    exit();
}

// Include database connection file
require '../db-connector.php';

// Check if admin ID is set in the URL
if (isset($_GET['id'])) {
    // Sanitize and validate the admin ID
    $admin_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    
    if ($admin_id) {
        // Prepare and execute the query to fetch the admin record
        $adminRecord = $connection->prepare("SELECT * FROM admins WHERE admin_id = ?");
        $adminRecord->bind_param("i", $admin_id);
        
        if (!$adminRecord->execute()) {
            die("Error executing the query: " . $adminRecord->error);
        }
        
        $result = $adminRecord->get_result();
        
        if ($result->num_rows > 0) {
            $selected_admin = $result->fetch_assoc();
            $new_role = ($selected_admin["admin_role"] == "s_admin") ? "n_admin" : "s_admin";
            
            // Prepare and execute the update role query
            $updateRole = $connection->prepare("UPDATE admins SET admin_role = ? WHERE admin_id = ?");
            $updateRole->bind_param("si", $new_role, $admin_id);
            
            if (!$updateRole->execute()) {
                die("Error updating the admin role: " . $updateRole->error);
            }
            
            // Close the prepared statements and connection
            $updateRole->close();
        } else {
            die("No admin found with the given ID.");
        }
        
        $adminRecord->close();
    } else {
        die("Invalid admin ID.");
    }
    
    // Redirect to allAdmin.php
    header("Location: allAdmin.php");
    exit();
} else {
    echo "Invalid admin ID.";
}
?>
