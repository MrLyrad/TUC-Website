<?php


      include '../db-connector.php';

        $event_id = $_GET['id'];

        $getRecord = "SELECT * FROM events WHERE event_id = :event_id";
        $stmt = $pdo_obj->prepare($getRecord);
        $stmt->bindParam(':event_id', $event_id);
        $stmt->execute();
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        if($event){

            $event_image = $event['event_image'];
            $event_name = $event['event_name'];
            $event_location = $event['event_location'];
            $event_contact_person = $event['event_contact_person'];
            $event_contact = $event['event_contact'];
            $event_date_start = $event['event_date_start'];
            $event_date_end = $event['event_date_end'];
            $event_time_start = $event['event_time_start'];
            $event_time_end = $event['event_time_end'];
            $event_content = $event['event_content'];

            try{
            $addEvent = "INSERT INTO archived_events (event_image, event_name, event_location, event_contact_person, event_contact, event_date_start, event_date_end, event_time_start, event_time_end, event_content)
            VALUES ('$event_image', '$event_name', '$event_location', '$event_contact_person', '$event_contact', '$event_date_start', '$event_date_end', '$event_time_start', '$event_time_end', '$event_content')";
            $pdo_obj->exec($addEvent);
    
    
            $deleteForeign = "DELETE FROM volunteer_events WHERE event_id = :event_id";
            $stmt = $pdo_obj->prepare($deleteForeign);
            $stmt->execute(['event_id' => $event_id]);
    
            $deleteRecord = "DELETE FROM events WHERE event_id = :event_id";
            $stmt = $pdo_obj->prepare($deleteRecord);
            $stmt->execute(['event_id' => $event_id]);

            echo 
              "
              <script>
              alert('Event Archived');
              document.location.href = 'adminHome.php';
              </script>
              ";

        }catch (Exception $e){
            echo "ERROR";
        }
        }
?>