<?php
    //including config.php
    require_once "includes/config.php";
    
    // Defining variables and initialize with empty values
    $email = $password = $confirm_password = "";
    $email_err = $password_err = $confirm_password_err = $firstname_err = $lastname_err = $address_err = $postcode_err = $city_err = $phone_err = "";

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

        // Validating username
        if(empty(trim($_POST["brugerMail"])))
        {
            $email_err = "Indtast venligst en Email.";
        } 
        else
        {
            // Preparing a select statement
            $sql = "SELECT id FROM users WHERE UEmail = ?";
     
            if($stmt = mysqli_prepare($mysqli, $sql))
            {
                // Binds variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);
         
                // Sets parameters
                $param_email = trim($_POST["brugerMail"]);
         
                // Attempting to execute the prepared statement
                if(mysqli_stmt_execute($stmt))
                {
                    /* store result */
                    mysqli_stmt_store_result($stmt);
             
                    if(mysqli_stmt_num_rows($stmt) == 1)
                    {
                        $email_err = "Denne Email er allerede i brug.";
                    } 
                    else
                    {
                        $email = trim($_POST["brugerMail"]);
                    }
                } 
                else
                {
                    echo "Noget gik galt prøv igen senere.";
                }
            }
      
            // Closes the statement
            mysqli_stmt_close($stmt);
        }
 
        // Validating password
        if(empty(trim($_POST["brugerPassword"])))
        {
            $password_err = "Indtast venligst en Adgangskode.";     
        } 
        elseif(strlen(trim($_POST["brugerPassword"])) < 6)
        {
            $password_err = "Adgangskoden skal mindst have 6 tegn.";
        } 
        else
        {
            $password = trim($_POST["brugerPassword"]);
        }
 
        // Validating confirm password
        if(empty(trim($_POST["brugerGentagPassword"])))
        {
            $confirm_password_err = "Bekræft venligst adgangskoden.";     
        } 
        else
        {
            $confirm_password = trim($_POST["brugerGentagPassword"]);
            if(empty($password_err) && ($password != $confirm_password))
            {
                $confirm_password_err = "De to adgangskoder er ikke ens.";
            }
        }

        // Checking for input errors before inserting in database
        if(empty($email_err) && empty($password_err) && empty($confirm_password_err))
        {
     
            // Prepare an insert statement
            $sql = "INSERT INTO users (UEmail, UPassword, UFistname, ULastname, UAddress, UPostcode, UCity, UPhone) VALUES (?, ?)";
      
            if($stmt = mysqli_prepare($mysqli, $sql))
            {
                // Binds variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);
         
                // Sets parameters
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
         
                // Attempting to execute the prepared statement
                if(mysqli_stmt_execute($stmt))
                {
                    // Redirecting to login page
                    header("location: login.php");
                } 
                else
                {
                    echo "Noget gik galt prøv igen senere.";
                }
            }
      
            // Closes the statement
            mysqli_stmt_close($stmt);
        }
 
        // Closes the connection
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
    <title>Starup UIF arrangementer - opret bruger</title>
</head>
<body>
    <header>
        <?php
            include "includes/nav.php";
        ?>
    </header>
    <main>
        <section>
            <h1>Opret bruger</h1>

            <article>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <p class="form-group">
                        <label for="brugerMail">Email: </label>
                        <input type="email" name="brugerMail" placeholder="[php kode]" required>
                        <span class="error">* <?php echo $email_err;?></span>
                    </p>
                    <p class="form-group">
                        <label for="brugerPassword">Adgangskode:</label>
                        <input type="password" name="brugerPassword" placeholder="[php kode]" required>
                        <span class="error">* <?php echo $password_err;?></span>
                        <label for="brugerGentagPassword">Gentag adgangskode:</label>
                        <input type="password" name="brugerGentagPassword" placeholder="[php kode]" required>
                        <span class="error">* <?php echo $confirm_password_err;?></span>
                    </p>
                    <p class="form-group">
                        <label for="brugerFornavn">Fornavn: </label>
                        <input type="text" name="brugerFornavn" placeholder="[php kode]">
                    </p>
                    <p class="form-group">
                        <label for="brugerEfternavn">Efternavn: </label>
                        <input type="text" name="brugerEfternavn" placeholder="[php kode]">
                    </p>
                    <p class="form-group">
                        <label for="brugerAdresse">Adresse: </label>
                        <input type="text" name="brugerAdresse" placeholder="[php kode]">
                    </p>
                    <p class="form-group">
                        <label for="brugerPostnr">Postnummer: </label>
                        <input type="text" name="brugerPostnr" placeholder="[php kode]">
                        <label for="brugerBy">By: </label>
                        <input type="text" name="brugerBy" placeholder="[php kode]">
                    </p>
                    <p class="form-group">
                        <label for="brugerTlfnr">Telefonnummer: </label>
                        <input type="text" name="brugerTlfnr" placeholder="[php kode]">
                    </p>
                    

                    <input type="submit" value="Opret" class="btn btn-primary" name="brugerSubmit">
                </form>

            </article>

        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>