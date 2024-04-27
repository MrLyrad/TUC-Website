<?php
    session_start();
    if (!isset($_SESSION["admin"])) {
        header("Location: ../authentication/adminLogin.php");
    }
?>
<?php
// Include database connection file
include '../db-connector.php';

    if (isset($_GET['id']))
    {
        $event_id = $_GET['id'];

        //Prepare DELETE statement
        $deleteRecord = "DELETE FROM events WHERE event_id = :event_id";

        //Execute statement
        $stmt = $pdo_obj->prepare($deleteRecord);
        $stmt->execute(['event_id' => $event_id]);

    // Check if deletion was successful
    if($stmt->rowCount() > 0) {
        // Redirect back to the page displaying all events
        echo 
        "
        <script>
        alert('Event Deleted');
        </script>
        ";
        header("Location: contentDashboard.php");
        exit();
    } 
    else 
    {
        echo "Failed to delete the event.";
    }
    } 
    else 
    {
        echo "Invalid event ID.";
    }

?>
