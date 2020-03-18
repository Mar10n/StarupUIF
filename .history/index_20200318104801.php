<?php
    session_start();
    // including config file
    require_once "includes/config.php";
    $Lager = $mysqli->query("SELECT EImage FROM events");
    $showAll = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Starup UIF arrangements kalender. Opret nye arrangementer - tilmeld dig arrangementer. Et godt sted at starte et aktivt og interessant fritidsliv.">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Starup UIF arrangementer</title>
</head>
<body>
    <header>
        <?php
            include "includes/nav.php";
        ?>
    </header>
    <main class="ml-3">
        <h1>Kommende arrangementer i Starup UIF</h1>
        <section>

            <form method="post">
                <label for="eventCategory">Vælg kategori</label>
                <select name="eventCategory">
                    <option value="Alle" selected>Alle</option>
                    <option value="Musik">Musik</option>
                    <option value="Kunst">Kunst</option>
                    <option value="Foredrag">Foredrag</option>
                    <option value="Sport">Sport/idræt</option>
                    <option value="Natur">Natur</option>
                    <option value="Andet">Andet</option>
                </select>
                <input type="submit" name="catChooser" class="btn btn-primary" value="Udfør">
            </form>

            <article>

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    $_SESSION += $_POST;
                    $_SESSION['eventCategory'] = $_POST['eventCategory'];
                }
                if (isset($_POST['catChooser']))
                {
                    # code...
                }
                while ($ImgLager = $Lager->fetch_assoc()) 
                {
                    $resimgLager[] = $ImgLager;
                }
            
                $stmt = $mysqli->query("SELECT * FROM events");
            
            
                while ($row = $stmt->fetch_assoc()) 
                {
            
                    $eventrow[] = $row;
            
            
                    $rowCount = count($eventrow);
                }
                echo 
                "<div class='Test'>";
                echo 
                "<div class='image_grid'>";
                $tæller = 0;
            
                for ($i = 0; $i < $rowCount; $i++) 
                {
                    $tæller = "item-$i";
              
            
                    if (strpos($resimgLager[$i]['EImage'], ' ')) 
                    {
                    $resimgLagerexplode = explode(' ', $resimgLager[$i]['EImage']);
                    $resimgLager[$i]['EImage'] = $resimgLagerexplode[0];
                    }
                    else
                    {
            
                    }
                    if (isset($_POST['catChooser']) || $_POST['eventCategory'] != 'alle')
                    {
                        $_SESSION += $_POST;
                        if ($_POST['eventCategory'] == $eventrow[$i]['ECategory'])
                        {
                            # code...
                        }
                    }
                    if (isset($_POST['showAllEvents'])) {
                        $rowCount = count($eventrow);
                        $showAll = " ";
                    }
                    echo
                        "<main class='card'>
                        <div class='card-header'>
                        <h3>{$eventrow[$i]['EName']}</h3>
                        </div>
                        <div class='$tæller card-body'>
                        <img src='img/{$resimgLager[$i]['EImage']}'>
                        </div>
                        <div class='card-footer'>
                        <p>Beskrivelse: {$eventrow[$i]['EDescription']}</p>
                        <p>Dato: {$eventrow[$i]['EDate']}</p>
                        <p>Start tid: {$eventrow[$i]['EStartTime']}</p>
                        <p>Slut tid: {$eventrow[$i]['EEndTime']}</p>
                        <p>Sted: {$eventrow[$i]['EPlace']}</p>
                        <p>Pris: {$eventrow[$i]['EPrice']}</p>
                        <p>Max deltagere: {$eventrow[$i]['EMaxPart']}</p>
                        <p>Nuværende tiltagere: {$eventrow[$i]['ECurrPart']}</p>
                        <p>Kontakt navn: {$eventrow[$i]['EContactName']}</p>
                        <p>Tlf nummer: {$eventrow[$i]['EContactPhone']}</p>
                        <p>Oprettet af: {$eventrow[$i]['ECreatedBy']}</p>
                        <a href='visArrangement.php?id={$eventrow[($i)]['EID']}' class='myButton'>Tilmeld!</a>
                        </div>
                        </main>"
                    ;
                }
                ?>

            </article>

            <form method="post">
                <input type="submit" name="showAllEvents" class="btn btn-primary" value="Vis Alle Arrangementer"> <!-- eller som link til index-siden igen med angivelse af et argument, som fortæller, at man gerne vil se alle arrangementer -->
            </form>

        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>