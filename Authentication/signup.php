<!DOCTYPE html>
<html>
    <body>
        <form method="post">
            <?php
                //Run once form is submitted
                if (isset($_POST["submit"])) {
                    //initiate input variables
                    $fullname = $_POST["full_name"];
                    $email = $_POST["email"];
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    $password_confirmation = $_POST["password_rep"];
                    
                    //store errors
                    $errs = array();
                    
                    //secure the password
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);

                    //check if complete inputs
                    if(empty($fullname) OR empty($email) OR empty($username) OR empty($password)) {
                        array_push( $errs,"All field are required");
                    }

                    //check if email format valid
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        array_push( $errs,"Enter a valid email");
                    }

                    //check if passwords match
                    if($password!=$password_confirmation){
                        array_push( $errs,"Password does not match");
                    }

                    //checks error counter
                    if(count($errs) > 0) {  //errors are detected
                        foreach($errs as $err) {
                            //!!! please provide class name for customizing div !!!
                            echo "<div>$err</div>";
                        }
                    } else {    //input requirements fulfilled, initiate connection
                        require_once("../db-connector.php");    //connector file

                        //SQL statment for insertion of inputs to DB
                        $sql = "INSERT INTO volunteers (full_name, email, username, password) VALUES (?,?,?,?)"; //Values are abstracted to prevent SQL injection

                        $stmt = mysqli_stmt_init($connection);  //create statement
                        $prepare = mysqli_stmt_prepare($stmt, $sql);    //prepare SQL statement

                        //Save volunteer registration
                        if($prepare) {  //connection successful, complete the parameter details

                            //complete preparation statement
                            mysqli_stmt_bind_param($stmt,"ssss", $fullname, $email, $username, $password_hash); //Define input variables here for storing to DB
                            mysqli_stmt_execute($stmt); //execute the statment

                            echo "<div>Registration Successful!</div>"; //success confirmation
                        } else {
                            die("Something went wrong"); //database connection unsuccessful
                        }
                    }
                }
            ?>

            <!--Registration form-->
            <h1>Full name</h1>
            <input type="text" id="full_name" name="full_name">
            <br />
            <h1>Email</h1>
            <input type="email" id="email" name="email">
            <br />
            <h1>Username</h1>
            <input type="text" id="username" name="username">
            <br />
            <h1>Password</h1>
            <input type="password" id="password" name="password">
            <br />
            <h1>Confirm Password</h1>
            <input type="password" id="password_rep" name="password_rep">
            <br />
            <input type="submit" id="submit-button" name="submit" value="register">
            <br />
        </form>

        <br />
        <p>Already have an account?</p>
        <!-- Redirect to Registration -->
        <button onclick="window.location.href='login.php';">login</button>

        <br />
        <button onclick="window.location.href='../index.html';">Maybe next time</button>
    </body>
</html>