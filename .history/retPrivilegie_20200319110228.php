<?php
    // Includes the config file
    require_once "includes/config.php";
    $UpdateMsg = "";

    if($db->connect_error)
    {
        echo $db->connect_error;
    }
    else
    {
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            if(isset($_POST['admAccRetBruger']))
            {
                if($db->query("UPDATE users SET UFirstname = '{$_POST['brugerFornavn']}', ULastname = '{$_POST['brugerEfternavn']}', UAddress = '{$_POST['brugerAdresse']}', UPostcode = '{$_POST['brugerPostnr']}', UCity = '{$_POST['brugerBy']}', UPhone = '{$_POST['brugerTlfnr']}', UPriviledge = '{$_POST['brugerPrivilegie']}' WHERE UEmail = '{$_POST['brugerMail']}'"))
                {
                    $UpdateMsg = "Brugeren er opdateret!";
                    $currUserMail = $_POST['brugerMail'];
                    $currUserFName = $_POST['brugerFornavn'];
                    $currUserLName = $_POST['brugerEfternavn'];
                    $currUserAdd = $_POST['brugerAdresse'];
                    $currUserPost = $_POST['brugerPostnr'];
                    $currUserCity = $_POST['brugerBy'];
                    $currUserPhone = $_POST['brugerTlfnr'];
                    if($_POST['brugerPrivilegie'] == "Bruger")
                    {
                        $bruger = "selected";
                        $moderator = "";
                        $administrator = "";
                    }
                    elseif($_POST['brugerPrivilegie'] == "Moderator")
                    {
                        $bruger = "";
                        $moderator = "selected";
                        $administrator = "";
                    }
                    elseif($_POST['brugerPrivilegie'] == "Administrator")
                    {
                        $bruger = "";
                        $moderator = "";
                        $administrator = "selected";
                    }
                }
                else
                {
                    $UpdateMsg = "Brugeren blev ikke opdateret!";
                }
            }
        }

        $result = $db->query("SELECT * FROM users");

        if($db->error)
        {
            echo $db->error;
        }
        else
        {
            while($userRow = $result->fetch_assoc())
            {
                $allUsers[] = $userRow;
            }
        }
    }

    
    
    

    
    if(!isset($_POST['chooseUser']))
    {
        
        $currUserMail = $allUsers[0]['UEmail'];
        $currUserFName = $allUsers[0]['UFirstname'];
        $currUserLName = $allUsers[0]['ULastname'];
        $currUserID = $allUsers[0]['UID'];
        $currUserAdd = $allUsers[0]['UAddress'];
        $currUserPost = $allUsers[0]['UPostcode'];
        $currUserCity = $allUsers[0]['UCity'];
        $currUserPhone = $allUsers[0]['UPhone'];
        if($allUsers[0]['UPriviledge'] == "Bruger")
        {
            $bruger = "selected";
            $moderator = "";
            $administrator = "";
        }
        elseif($allUsers[0]['UPriviledge'] == "Moderator")
        {
            $bruger = "";
            $moderator = "selected";
            $administrator = "";
        }
        elseif($allUsers[0]['UPriviledge'] == "Administrator")
        {
            $bruger = "";
            $moderator = "";
            $administrator = "selected";
        }
    }

    // print_r($allUsers);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <meta name="description" content="Starup UIF arrangements kalender. Opret nye arrangementer - tilmeld dig arrangementer. Et godt sted at starte et aktivt og interessant fritidsliv.">
    <title>Starup UIF arrangementer - ret brugerprivilegie</title>
</head>
<body>

    <?php @include "nav.php"; ?>

    <header>
        <img src="img/header-img-lg.jpg" class="img-fluid">
    </header>
    <main class="container">
        <section>
            <h1 class="mt-5 mb-5">Ret bruger</h1>

            <article>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-6">
                            <label for="vaelgBruger">Vælg bruger:</label>
                            <select name="vaelgBruger" class="form-control">
                                <?php
                                    // Opret et select field (dropdown box) hvor alle brugerne fra tabellen users indsættes, så administratorer kan vælge, hvilken bruger de vil ændre i
                                    foreach($allUsers as $user)
                                    {
                                        if($_SERVER['REQUEST_METHOD'] == "POST")
                                        {
                                            // $selectedUser = $_POST['vaelgBruger'];

                                            if($user['UEmail'] == $_POST['vaelgBruger'])
                                            {
                                                echo "<option value='{$user['UEmail']}' selected>{$user['UEmail']} | {$user['UFirstname']} {$user['ULastname']}</option>";
                                                $currUserMail = $user['UEmail'];
                                                $currUserFName = $user['UFirstname'];
                                                $currUserLName = $user['ULastname'];
                                                $currUserID = $user['UID'];
                                                $currUserAdd = $user['UAddress'];
                                                $currUserPost = $user['UPostcode'];
                                                $currUserCity = $user['UCity'];
                                                $currUserPhone = $user['UPhone'];
                                                if($user['UPriviledge'] == "Bruger")
                                                {
                                                    $bruger = "selected";
                                                    $moderator = "";
                                                    $administrator = "";
                                                }
                                                elseif($user['UPriviledge'] == "Moderator")
                                                {
                                                    $bruger = "";
                                                    $moderator = "selected";
                                                    $administrator = "";
                                                }
                                                elseif($user['UPriviledge'] == "Administrator")
                                                {
                                                    $bruger = "";
                                                    $moderator = "";
                                                    $administrator = "selected";
                                                }

                                            }
                                            else
                                            {
                                                echo "<option value='{$user['UEmail']}'>{$user['UEmail']} | {$user['UFirstname']} {$user['ULastname']}</option>";

                                            }
                                        }
                                        else
                                        {
                                            echo "<option value='{$user['UEmail']}'>{$user['UEmail']} | {$user['UFirstname']} {$user['ULastname']}</option>";

                                        }
                                        
                                    }
                                ?>                        
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="submit" name="chooseUser" value="Vælg" class="btn btn-primary">
                        </div>
                    </div>
                    
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-3">
                            <label for="brugerMail">Email: </label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="email" name="brugerMail" value="<?php echo $currUserMail; ?>" class=" form-control form-control-plaintext" readonly>
                        </div>
                    </div>
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-3">
                            <label for="brugerPrivilegie">Privilegie:</label>
                        </div>
                        <div class="form-group col-md-3">
                            <select name="brugerPrivilegie" class="form-control">
                                <option value="Administrator" <?php echo $administrator; ?>>Administrator</option>
                                <option value="Moderator" <?php echo $moderator; ?>>Moderator</option>
                                <option value="Bruger" <?php echo $bruger; ?>>Bruger</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-3">
                            <label for="brugerFornavn">Fornavn: </label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" name="brugerFornavn" value="<?php echo $currUserFName; ?>"  class="form-control">
                        </div>
                    </div>
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-3">
                            <label for="brugerEfternavn">Efternavn: </label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" name="brugerEfternavn" value="<?php echo $currUserLName; ?>"  class="form-control">
                        </div>
                    </div>
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-3">
                            <label for="brugerAdresse">Adresse: </label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" name="brugerAdresse" value="<?php echo $currUserAdd; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-3">
                            <label for="brugerPostnr">Postnummer: </label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" name="brugerPostnr" value="<?php echo $currUserPost; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-3">
                            <label for="brugerBy">By: </label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" name="brugerBy" value="<?php echo $currUserCity; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-3">
                            <label for="brugerTlfnr">Telefonnummer: </label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" name="brugerTlfnr" value="<?php echo $currUserPhone; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-3">
                            <input type="submit" value="Acceptér Ændringer" name="admAccRetBruger" class="btn btn-primary">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="submit" value="Fortryd Ændringer" name="admFortrRetBruger" class="btn btn-primary">
                        </div>
                    </div>
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-3">
                            <?php echo $UpdateMsg; ?>
                        </div>
                    </div>
                </form>
            </article>
        </section>
    </main>
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>