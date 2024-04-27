<?php
    session_start();
    if (!isset($_SESSION["admin"])) {
        header("Location: ../authentication/adminLogin.php");
    }
?>
<!DOCTYPE html>
<html>
    <body>
        <h1>Add an Admin</h1>
        <br />
        <form method="post">
            <?php
                //Run once form is submitted
                if (isset($_POST["register"])) {
                    //initiate input variables
                    $email = $_POST["admin_email"];
                    $fullname = $_POST["admin_fullname"];
                    $password = $_POST["admin_password"];
                    $password_confirmation = $_POST["password_rep"];
                    
                    //store errors
                    $errs = array();
                    
                    //secure the password
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);

                    //check if complete inputs
                    if(empty($fullname) OR empty($email) OR empty($password)) {
                        array_push( $errs,"All fields are required");
                    }

                    //check if email format valid
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        array_push( $errs,"Enter a valid email");
                    }

                    //check if passwords match
                    if($password!=$password_confirmation){
                        array_push( $errs,"Password does not match");
                    }

                    require_once("../db-connector.php");    //connector file
                    
                    $email_query = "SELECT * FROM admins WHERE admin_email = '$email'";
                    $username_query = "SELECT * FROM admins WHERE admin_fullname = '$fullname'";
                    $email_data = mysqli_query($connection, $email_query);
                    $username_data = mysqli_query($connection, $username_query);
                    $email_rows = mysqli_num_rows($email_data);
                    $username_rows = mysqli_num_rows($username_data);

                    if ($email_rows>0){
                        array_push($errs, "Email already exists!");
                    }

                    if ($username_rows>0){
                        array_push($errs, "Admin already exists!");
                    }


                    //checks error counter
                    if(count($errs) > 0) {  //errors are detected
                        foreach($errs as $err) {
                            //!!! please provide class name for customizing div !!!
                            echo "<div>$err</div>";
                        }
                    } else {    //input requirements fulfilled, initiate connection
                        //SQL statment for insertion of inputs to DB
                        $sql = "INSERT INTO admins (admin_fullname, admin_email, admin_password) VALUES (?,?,?)"; //Values are abstracted to prevent SQL injection

                        $stmt = mysqli_stmt_init($connection);  //create statement
                        $prepare = mysqli_stmt_prepare($stmt, $sql);    //prepare SQL statement

                        //Save volunteer registration
                        if($prepare) {  //connection successful, complete the parameter details

                            //complete preparation statement
                            mysqli_stmt_bind_param($stmt,"sss", $fullname, $email, $password_hash); //Define input variables here for storing to DB
                            mysqli_stmt_execute($stmt); //execute the statment

                            echo "<div>Registration Successful!</div>"; //success confirmation
                        } else {
                            die("Something went wrong"); //database connection unsuccessful
                        }
                    }
                }
            ?>

            <!--Registration form-->
            <h1>Email</h1>
            <input type="email" id="admin_email" name="admin_email">
            <br />
            <h1>Full Name</h1>
            <input type="text" id="admin_fullname" name="admin_fullname">
            <br />
            <h1>Password</h1>
            <input type="password" id="admin_password" name="admin_password">
            <br />
            <h1>Confirm Password</h1>
            <input type="password" id="password_rep" name="password_rep">
            <br />
            <input type="submit" id="register-button" name="register" value="register">
            <br />
        </form>
    </body>
</html>