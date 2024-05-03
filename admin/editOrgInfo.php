<!DOCTYPE html>
<html lang="en">

<body>
    <h1>Edit Organization Details</h1>
    <?php
        require_once("../db-connector.php");
        $query = "SELECT * FROM org_info";
        $statement = $pdo_obj->query($query);
        $rowsReturned = $statement->rowCount();

        if ($rowsReturned > 0) {
            while ($org_details = $statement->fetch(PDO::FETCH_ASSOC)) {
                $org_addressnum = $org_details["org_addressnum"];
                $org_street = $org_details["org_street"];
                $org_brgy_mncplty = $org_details["org_brgy_mncplty"];
                $org_city_state_province = $org_details["org_city_state_province"];
                $org_country = $org_details["org_country"];
                $org_email = $org_details["org_email"];
                $org_map = $org_details["org_map"];
                $org_contactnum = $org_details["org_contactnum"];
            }
        } else {
            $org_addressnum = "";
            $org_street = "";
            $org_brgy_mncplty = "";
            $org_city_state_province = "";
            $org_country = "";
            $org_email = "";
            $org_map = "";
            $org_contactnum = "";
        }

        echo   "<form method='post'>
                    <input type='url' name='org_map' id='mapLinkInput' placeholder='Enter map URL here' value='".$org_map."' required>
                    <button type='button' onclick='updateMap()'>Update Map</button>
                    <br>
                    <div style='border: 2px solid black; /* Sets a 2px wide solid black border */
                        padding: 10px; /* Adds padding inside the div */
                        width: 600px; /* Sets the width of the div */
                        height: 450px; /* Sets the height of the div */'>
                        <iframe src='".$org_map."' width='600' height='450' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade' id='mapDisplay'></iframe>
                    </div>
                    <br>
                    <h1>Organization Address</h1>
                    <label for='org_addressnum' class='textlabel input-head'>Address Number</label><br>
                    <input type='text' name='org_addressnum' value='".$org_addressnum."'>
                    <br>
                    <label for='org_street' class='textlabel input-head'>Street</label><br>
                    <input type='text' name='org_street' value='".$org_street."' required>
                    <br>
                    <label for='org_brgy_mncplty' class='textlabel input-head'>Barangay/Municipality</label><br>
                    <input type='text' name='org_brgy_mncplty' value='".$org_brgy_mncplty."' required>
                    <br>
                    <label for='org_city_state_province' class='textlabel input-head'>City, State/Province</label><br>
                    <input type='text' name='org_city_state_province' value='".$org_city_state_province."' required>
                    <br>
                    <label for='org_country' class='textlabel input-head'>Country</label><br>
                    <input type='text' name='org_country' value='".$org_country."' required>
                    <br>
                    <label for='org_contactnum' class='textlabel input-head'>Contact Number</label><br>
                    <input type='tel' name='org_contactnum' pattern='\d{11}' class='form-control' value='".$org_contactnum."' required>
                    <br>
                    <label for='org_email' class='textlabel input-head'>Email</label><br>
                    <input type='email' name='org_email' class='form-control' value='".$org_email."' required>
                    <br>
                    <input type='submit' name='update'>
                </form>";

                if(isset($_POST["update"])){
                    $org_addressnum = $_POST["org_addressnum"];
                    $org_street = $_POST["org_street"];
                    $org_brgy_mncplty = $_POST["org_brgy_mncplty"];
                    $org_city_state_province = $_POST["org_city_state_province"];
                    $org_country = $_POST["org_country"];
                    $org_email = $_POST["org_email"];
                    $org_map = $_POST["org_map"];
                    $org_contactnum = $_POST["org_contactnum"];

                    if($rowsReturned>0){
                        $sql = "UPDATE org_info SET org_addressnum = ?, 
                                org_street = ?, org_brgy_mncplty = ?, 
                                org_city_state_province = ?, org_country = ?, 
                                org_contactnum = ?, org_email = ?, 
                                org_map = ? WHERE info_id = '1'"; //Values are abstracted to prevent SQL injection
                        $stmt = mysqli_stmt_init($connection);  //create statement
                        $prepare = mysqli_stmt_prepare($stmt, $sql);    //prepare SQL statement

                    } else {
                        $sql = "INSERT INTO org_info (org_addressnum, org_street, org_brgy_mncplty, 
                                org_city_state_province, org_country, org_contactnum, org_email, org_map) 
                                VALUES (?,?,?,?,?,?,?,?)";
                        $stmt = mysqli_stmt_init($connection);  //create statement
                        $prepare = mysqli_stmt_prepare($stmt, $sql);    //prepare SQL statement
                    }

                    if($prepare){
                        mysqli_stmt_bind_param($stmt, "sssssiss", $org_addressnum, $org_street, $org_brgy_mncplty, $org_city_state_province, $org_country, $org_contactnum, $org_email, $org_map);
                        mysqli_stmt_execute($stmt);
                        header("Location: editOrgInfo.php");
                        die();
                    } else {
                        echo "Something went wrong";
                        header("Location: editOrgInfo.php");
                        die();
                    }
                }
    ?>
    <script>
        function updateMap() {
            var mapLink = document.getElementById('mapLinkInput').value;
            var mapDisplay = document.getElementById('mapDisplay');
            mapDisplay.src = mapLink;
        }
    </script>
</body>

</html>
