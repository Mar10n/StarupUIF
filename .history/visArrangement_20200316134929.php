<?php
    session_start();
    // including config file
    require_once "includes/config.php";
?>

<?php
    $id = $_GET['EID'];
    $imgcount = 0;
    $Lager = $mysqli->query("SELECT EImage FROM events WHERE EID = $id ");
    $imgCountVarible = 0;
    while ($ImgLager = $Lager->fetch_assoc())
    {
        $resimgLager[] = $ImgLager;
        $resimgLagerexplode = explode(' ', $resimgLager[0]['EImage']);
        if (count($resimgLagerexplode)) {
            $imgcount = count($resimgLagerexplode);
        }
        else 
        {

        }
    }
    $stmt = $mysqli->query("SELECT * FROM events WHERE EID = $id ");


    /*while ($row = $stmt->fetch_assoc())
    {
        $productrow[] = $row;
        $rowCount = count($productrow);
    }

    echo
    "<div class='image_grid'>";
    for ($i = 0; $i < $imgcount; $i++)
    {

        $tæller = "item-$i";
        echo
            "<div class='$tæller'>
               
            <img src='img/{$resimgLagerexplode[$i]}'>
       
            </div>"
        ;
    }

        echo "</div>";
        echo 
        "<div class ='DynText'>
        <p>Dato :{$productrow[0]['EDate']},-</p> 
        <p>Start tidspunkt: {$productrow[0]['EStartTime']} På lager</p>
        <p>Slut tidspunkt: {$productrow[0]['EEndTime']}</p>
        <a href='#' class='myButton'>Tilmeld</a>
        </div>";
?>*/

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Starup UIF arrangements kalender. Opret nye arrangementer - tilmeld dig arrangementer. Et godt sted at starte et aktivt og interessant fritidsliv.">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Starup UIF arrangementer - vis arrangement</title>
</head>
<body>
    <header>
        <?php
            include "includes/nav.php";
        ?>
    </header>
    <main>
        <section>

            <article>

                <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <p class="form-group">
                    <label for="tilmeldAntal">Tilmeld antal:</label>
                    <input type="number" name="tilmeldAntal">
                    <input type="submit" class="btn btn-primary" value="Tilmeld" name="tilmeldArrangement"></p>
                    <input type="submit" class="btn btn-primary" value="Ret Arrangement" name="retArrangement">
                    <input type="submit" class="btn btn-primary" value="Acceptér Ændringer" name="accRetArrangement">
                    <input type="submit" class="btn btn-primary" value="Fortryd Ændringer" name="fortrRetArrangement">

                    
                    <p class="form-group">
                        <label for="eventNavn">Navn på arrangement: <?php echo "{$productrow[0]['EName']}";?></label>
                        <input type="text" name="eventNavn">
                    </p>
                    <p class="form-group">
                        <label for="eventCategory">Kategori</label>
                        <select name="eventCategory">
                            <option value="Musik">Musik</option>
                            <option value="Kunst">Kunst</option>
                            <option value="Foredrag">Foredrag</option>
                            <option value="Sport">Sport/idræt</option>
                            <option value="Natur">Natur</option>
                            <option value="Andet">Andet</option>
                        </select>
                    </p>
                    <p class="form-group">
                        <label for="eventBeskrivelse">Beskrivelse af arrangementet:</label>
                        <textarea placeholder="Indtast beskrivelse..." style="resize: none;"></textarea>
                    </p>
                    <p class="form-group">
                        <label for="eventImage">Upload et billede til/af arrangement:</label>
                        <input type="file" name="eventImage">
                    </p>
                    <p class="form-group">
                        <label for="eventDato">Dato: </label>
                        <input type="date" name="eventDato" min="2020-01-01" max="2020-12-31">
                    </p>
                    <p class="form-group">
                        <label for="eventStartTid">Start tidspunkt: </label>
                        <input type="time" name="eventStartTid">
                    </p>
                    <p class="form-group">
                        <label for="eventSlutTid">Slut tidspunkt (ikke påkrævet): </label>
                        <input type="time" name="eventSlutTid">
                    </p>
                    <p class="form-group">
                        <label for="eventSted">Sted: </label>
                        <input type="text" name="eventSted">
                    </p>
                    <p class="form-group">
                        <label for="eventMaxDelt">Max. antal deltagere: </label>
                        <input type="number" name="eventMaxDelt">
                    </p>
                    <p class="form-group">
                        <label for="eventAnsvarlig">Ansvarlig/kontaktperson: </label>
                        <input type="text" name="eventAnsvarlig">
                    </p>
                    <p class="form-group">
                        <label for="eventAnsvTlf">Telefonnummer ansvarlig/kontaktperson:</label>
                        <input type="text" name="eventAnsvTlf">
                    </p>
                </form>
            </article>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>