<?php
    // Includes the config file.
    require_once "includes/config.php";

    /* 
        Checking if the category is set.
        If it it then it's redirecting to the frontpage.
    */
    if(!isset($_GET['cat']))
    {
        header('location: index.php?cat=alle');
    }
    $today = date("Y-m-d");
    $rowCount = 5;

    $category = $_GET['cat'];
    
    if($category == "alle")
    {
        $result = $mysqli->query("SELECT * FROM events WHERE EDate > '$today' ORDER BY EDate, EStartTime ASC");
    }
    else
    {
        $result = $mysqli->query("SELECT * FROM events WHERE EDate > '$today' && ECategory = '$category' ORDER BY EDate, EStartTime ASC");
    }

    // Checking for db errors.
    if($mysqli->error)
    {
        echo $mysqli->error;
    }
    else
    {
        if($result->num_rows > 0)
        {
            while($rows = $result->fetch_assoc())
            {
                $eventrows[] = $rows;
            }
        }
        else
        {
            $eventrows[0]['EID'] = "";
        }

        if(count($eventrows) < 5)
        {
            $rowCount = count($eventrows);
        }

        if(isset($_GET['show']))
        {
            if($_GET['show'] == "all")
            {
                $rowCount = count($eventrows);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css">
    <meta name="description" content="Starup UIF arrangements kalender. Opret nye arrangementer - tilmeld dig arrangementer. Et godt sted at starte et aktivt og interessant fritidsliv.">
    <title>Starup UIF arrangementer</title>
</head>
<body>
    <?php include "includes/nav.php"; ?>

    <main class="container mb-5">
        
        <h1 class="mt-5 mb-5">Kommende arrangementer i Starup UIF</h1>

        <section>

            <div class="dropdown">
                <a href="#" class="btn btn-primary dropdown-toggle" role="button" data-toggle="dropdown" data-flip="false">Vælg kategori:</a>
                <div class="dropdown-menu" aria-labelledby="categoryChooser">
                    <a class="dropdown-item" href="index.php?cat=alle">Alle</a>
                    <a class="dropdown-item" href="index.php?cat=musik">Musik</a>
                    <a class="dropdown-item" href="index.php?cat=foredrag">Foredrag</a>
                    <a class="dropdown-item" href="index.php?cat=sport">Sport/idræt</a>
                    <a class="dropdown-item" href="index.php?cat=natur">Natur</a>
                    <a class="dropdown-item" href="index.php?cat=mad">Madlavning</a>
                    <a class="dropdown-item" href="index.php?cat=andet">Andet</a>
                </div>
            </div>

            <article class="showEvents mt-5">

                <?php
                    if($eventrows[0]['EID'] == "")
                    {
                        echo "<p>Der er desværre ingen kommende arrangementer i denne kategori.</p>";
                    }
                    else
                    {
                        for($i = 0; $i < $rowCount; $i++)
                        {
                            $EShortDesc = substr($eventrows[$i]['EDescription'], 0, 200);
                            if(strlen($eventrows[$i]['EDescription']) > 200)
                            {
                                $EShortDesc = $EShortDesc . "...";
                            }
                            echo "
                                <div class='card mb-5'>
                                    <div class='row'>
                                        <div class='col'>
                                            <img src='img/{$eventrows[$i]['EImage']}' class='card-img'>
                                        </div>
                                        <div class='col'>
                                            <div class='card-body'>
                                                <h4 class='card-title'>
                                                    {$eventrows[$i]['EName']}
                                                </h4>
                                                <p class='card-subtitle mt-3'>
                                                    Kategori: {$eventrows[$i]['ECategory']}
                                                </p>
                                                <p class='card-text mt-3'>
                                                    $EShortDesc
                                                </p>
                                                <p class='card-text mt-3'>
                                                    Dato: {$eventrows[$i]['EDate']}
                                                </p>
                                                <a class='btn btn-primary' href='visArrangement.php?id={$eventrows[($i)]['id']}'>Læs mere</a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ";
                        }
                    }

                    if(!isset($_GET['show']))
                    {
                        if(count($eventrows) > 5)
                        {
                            echo "<a href='index.php?cat=$category&show=all' class='btn btn-primary'>Vis alle arrangementer</a>";
                        }
                    }
                    else
                    {
                        echo "<a href='index.php?cat=$category' class='btn btn-primary'>Vis færre arrangementer</a>";
                        $rowCount = 5;
                    }
                ?>
            </article>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>