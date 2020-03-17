<?php
    //including config.php
    require_once "includes/config.php";
    // Initializing the session
    session_start();
    
    // Checking if the user is already logged in, if yes then redirect he user to index
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
    {
        header("location: index.php");
        exit;  
    }
 
 
    // Defining variables and initialize with empty values
    $email = $password = "";
    $email_err = $password_err = "";
 
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
 
        // Checking if the email is empty
        if(empty(trim($_POST["brugerMail"])))
        {
            $email_err = "Indtast venligst din email.";
        }
        else
        {
            $email = trim($_POST["brugerMail"]);
        }
    
        // Checking if the password is empty
        if(empty(trim($_POST["brugerPassword"])))
        {
            $password_err = "Indtast venligst din adgangskode.";
        }
        else
        {
            $password = trim($_POST["brugerPassword"]);
        }
    
        // Validating credentials
        if(empty($email_err) && empty($password_err))
        {
            // Preparing a select statement
            $sql = "SELECT UID, UEmail, password FROM users WHERE UEmail = ?";
        
            if($stmt = mysqli_prepare($mysqli, $sql))
            {
                // Binding variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);
            
                // Sets parameters
                $param_email = $email;
            
                // Attempting to execute the prepared statement
                if(mysqli_stmt_execute($stmt))
                {
                    // Storing result
                    mysqli_stmt_store_result($stmt);
                
                    // Checking if the username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1)
                    {                    
                        // Binding result variables
                        mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                        if(mysqli_stmt_fetch($stmt))
                        {
                            if(password_verify($password, $hashed_password))
                            {
                                // Password is correct, so start a new session
                                session_start();
                            
                            // Storing the data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["brugerMail"] = $email;                            
                            
                            // Redirecting the user to index
                            header("location: index.php");
                            }
                            else
                            {
                                // Displays an error message if password is not valid
                                $password_err = "Adgangskoden er ikke korrekt.";
                            }
                        }
                    } 
                    else
                    {
                        // Displays an error message if email doesn't exist
                        $email_err = "Der blev ikke fundet nogen bruger med den email.";
                    }
                }
                else
                {
                    echo "Noget gik galt prøv igen senere.";
                }
            }
        
        // Closing the statement
        mysqli_stmt_close($stmt);
    }
    
    // Closing the connection
    mysqli_close($mysqli);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Starup UIF arrangements kalender. Opret nye arrangementer - tilmeld dig arrangementer. Et godt sted at starte et aktivt og interessant fritidsliv.">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Starup UIF arrangementer - login</title>
</head>
<body>
    <header>
        <?php
            include "includes/nav.php";
        ?>
    </header>
    <h1>Login</h1>
    <section>
        <article>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <p class="form-group">
                    <label for="brugerMail">Email: </label>
                    <input type="email" name="brugerMail">
                </p>
                <p class="form-group">
                    <label for="brugerPassword">Adgangskode:</label>
                    <input type="password" name="brugerPassword">
                </p>

                <input type="submit" value="Log ind" class="btn btn-primary" name="loginSubmit">
            </form>
        </article>
    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>