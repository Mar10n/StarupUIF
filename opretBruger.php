<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Starup UIF arrangements kalender. Opret nye arrangementer - tilmeld dig arrangementer. Et godt sted at starte et aktivt og interessant fritidsliv.">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
                        <span class="error">* <?php echo $mailErr;?></span>
                    </p>
                    <p class="form-group">
                        <label for="brugerPassword">Adgangskode:</label>
                        <input type="password" name="brugerPassword" placeholder="[php kode]" required>
                        <span class="error">* <?php echo $pwErr;?></span>
                        <label for="brugerGentagPassword">Gentag adgangskode:</label>
                        <input type="password" name="brugerGentagPassword" placeholder="[php kode]" required>
                        <span class="error">* <?php echo $repeatPwErr;?></span>
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