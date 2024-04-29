<?php
  session_start();
  if(isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $volunteer_id = $user["volunteer_id"];
    $email = $user["email"];
    $username = $user["username"];
  } else {
    $user = null;
    $email = null;
    $username = null;
  }
?>
<?php
// Include database connection file
    include '../db-connector.php';

    if (isset($_GET['id']))
    {
        $event_id = $_GET['id'];

        // Prepare DELETE statement with named parameters to prevent SQL injection
        $deleteRecord = "DELETE FROM volunteer_events WHERE event_id = :event_id AND volunteer_id = :volunteer_id";
        $stmt = $pdo_obj->prepare($deleteRecord);

        // Bind parameters securely using named placeholders
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam(':volunteer_id', $volunteer_id, PDO::PARAM_INT);

// Execute the prepared statement
$stmt->execute();

    // Check if deletion was successful
    if($stmt->rowCount() > 0) {
        // Redirect back to the page displaying all events
        echo 
        "
        <script>
        alert('Event Deleted');
        </script>
        ";
        header("Location: ../my-events.php");
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
