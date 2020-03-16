<?php
    session_start();
    // including config file
    require_once "includes/config.php";
    $Lager = $mysqli->query("SELECT EImage FROM events");

    while ($ImgLager = $Lager->fetch_assoc()) {
        $resimgLager[] = $ImgLager;
    }

    $stmt = $mysqli->query("SELECT * FROM events");


    while ($row = $stmt->fetch_assoc()) {

        $eventrow[] = $row;


        $rowCount = count($eventrow);
    }
    echo 
    "<div class='Test'>";
    echo 
    "<div class='image_grid'>";
    $tæller = 0;

    for ($i = 0; $i < $rowCount; $i++) {
        $tæller = "item-$i";
  

        if (strpos($resimgLager[$i]['EImage'], ' ')) {
        $resimgLagerexplode = explode(' ', $resimgLager[$i]['EImage']);
        $resimgLager[$i]['EImage'] = $resimgLagerexplode[0];
        }
        else
        {

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
            <p>Beskrivelse:{$eventrow[$i]['EDescription']}</p>
            <p>Dato:{$eventrow[$i]['EDate']}</p>
            <p>Dato:{$eventrow[$i]['EStartTime']}</p>
            <p>Dato:{$eventrow[$i]['EEndTime']}</p>
            <p>Sted:{$eventrow[$i]['EPlace']}</p>
            <p>Dato:{$eventrow[$i]['EPrice']}</p>
            <p>Dato:{$eventrow[$i]['EPrice']}</p>
            <a href='DynamiskIndhold.php?id={$eventrow[($i)]['id']}' class='myButton'>Køb nu!</a>
            </div>
            </main>"
        ;
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
                    <option value="Alle">Alle</option>
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

                <p>[Arrangement billede (må gerne være i højformat her men må også gerne være i det format, der er vedlagt til opgaven)]</p>
                <p>[Arrangement beskrivelse - evt. forkortet eller afbrudt med ...]</p>
                <p>[Arrangement dato]</p>
                <p>[Arrangement starttidspunkt]</p>
                <p>[Arrangement sted]</p>

                <a href="visArrangement.html">Læs mere om dette arrangement...</a> <!-- Eller som knap -->

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