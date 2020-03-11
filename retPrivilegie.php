<?php

    // Opret forbindelse til databasen. Hvis du vil bruge HTML- og PHP-koden i body'en, skal du sørge for, at dine 
    // færdigbearbejdede database resultater ender i en variabel, der hedder $allUsers

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Starup UIF arrangements kalender. Opret nye arrangementer - tilmeld dig arrangementer. Et godt sted at starte et aktivt og interessant fritidsliv.">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Starup UIF arrangementer - ret brugerprivilegie</title>
</head>
<body>
    <main>
        <section>
            <h1>Opret bruger</h1>

            <article>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <select name="vaelgBruger">
                        <?php
                            // Opret et select field (dropdown box) hvor alle brugerne fra tabellen users indsættes, så administratorer kan vælge, hvilken bruger de vil ændre i
                            $i = 0;
                            foreach($allUsers as $user)
                            {
                                echo "<option value='{$allUsers[$i]['UEmail']}'>{$allUsers[$i]['UEmail']} | {$allUsers[$i]['UFirstname']} {$allUsers[$i]['ULastname']}</option>";
                                $i++;
                            }
                        ?>
                        
                            <input type="submit" value="Vælg" class="btn btn-primary" name="chooseUser">
                        
                    </select>
                </form>
                
                <form method="post">
                    <p class="form-group">
                        <label for="brugerMail">Email: </label>
                        <input type="email" name="brugerMail" placeholder="[php kode]">
                    </p>
                    <p class="form-group">
                        <label for="brugerPrivilegie">Privilegie:</label>
                        <select name="brugerPrivilegie">
                            <option value="Administrator">Administrator</option>
                            <option value="Moderator">Moderator</option>
                            <option value="Bruger" selected>Bruger</option>
                        </select>
                    </p>
                    <p class="form-group">
                        <label for="brugerFornavn">Fornavn: </label>
                        <input type="text" name="brugerFornavn" placeholder="[php kode]">
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
                    
                    <input type="submit" value="Acceptér Ændringer" class="btn btn-primary" name="admAccRetBruger">
                    <input type="submit" value="Fortryd Ændringer" class="btn btn-primary" name="admFortrRetBruger">
                </form>
            </article>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>