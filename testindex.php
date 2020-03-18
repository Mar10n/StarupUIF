<?php

$showAll = "";
/* We check if session is not set, if true we set session */
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

 
/* Create connection to datatbase
   Database info in variables, makes it easier if changes are neccesary*/

   $servername = "localhost";
   $usernamedb = "victoria";
   $passworddb = "victoria";
   $namedb = "starupuif";

   $db = new MySQLi($servername, $usernamedb, $passworddb, $namedb);   
 /* Check if any errors happen while connecting to the db*/
 if($db->connect_error){
     /* If an error occurs, the connection is killed*/
     die("Connection to database failed:". $db->connect_error);
 }
 else{
/* If no errors, we fetch all information from table products and put them in the variable result */
  
     $result = $db->query("SELECT * FROM events ORDER BY ABS( DATEDIFF( EDate, NOW() ) )");
     if($db->error){
         /* If an error occurs we echo the error*/
         echo $db->error;
     }
     else{
         /* If not we take use the function fetch_assoc to take our info from result
            and put it into a array while row = resultfetch assoc */
         while($row = $result->fetch_assoc()){
             $eventrow[] = $row;
         }
      }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <meta name="description" content="Starup UIF arrangements kalender. Opret nye arrangementer - tilmeld dig arrangementer. Et godt sted at starte et aktivt og interessant fritidsliv.">
    <title>Starup UIF arrangementer</title>
</head>
<body>
    <?php
        include "include/nav.php";
    ?>
    <main class="container">
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
                <input type="submit" name="catChooser" value="Udfør">
            </form>

    <?php
    $rowCount = 5;
            $showAll ="<form method='post'>
                        <input type='submit' name='showAllEvents' value='Vis Alle Arrangementer'> 
                       </form>";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        /* += so the things in post are not deleted */
        $_SESSION += $_POST;
        $_SESSION['eventCategory'] = $_POST['eventCategory'];

        if(isset($_POST['showAllEvents'])){
            $rowCount = count($eventrow);
            $showAll = " ";
        }
        
        if(isset($_SESSION['catChooser']) && $_SESSION['eventCategory'] != 'Alle'){
            
            echo "hesthest";
            for($j = 0; $j < $rowCount; $j++){

                if($_SESSION['eventCategory'] == $eventrow[$j]['ECategory']){

                $description = $eventrow[$j]['EDescription'];
                $description = substr($description,0,90);
                $eventDate = date("d-m-Y", strtotime($eventrow[$j]['EDate']));
                $eventimages[0] = $eventrow[$j]['EImage'];

                echo
                "<div class='col-md-4 card text-center mt-5'>
                <a href='test.php?id={$eventrow[$j]['EID']}'> 
                <img class='img-fluid' src='img/{$eventimages[0]}'>
                </a> 
                <div class='card-text'>
                <h2 class='h3 text-capitalize'>{$eventrow[$j]['EName']}</h2> 
                <p>{$eventDate}</p> 
                <p>{$description}...</p> 
                
                <div class='row  d-flex justify-content-center'>
                <a href='visArrangement.php?id={$eventrow[$j]['EID']}'> 
                <input type='submit' value='Læs mere' class=' btn btn-primary btn-block mr-2 mx-auto text-capitalize'>
                </a> 
                </div>
                </div>
                </div>";
                    
                }  
            }
        }
        else{
            for($j = 0; $j < $rowCount; $j++){
                $description = $eventrow[$j]['EDescription'];
                $description = substr($description,0,90);
                $eventDate = date("d-m-Y", strtotime($eventrow[$j]['EDate']));
                $eventimages[0] = $eventrow[$j]['EImage'];
                echo
                "<div class='col-md-4 card text-center mt-5'>
                <a href='test.php?id={$eventrow[$j]['EID']}'> 
                <img class='img-fluid' src='img/{$eventimages[0]}'>
                </a> 
                <div class='card-text'>
                <h2 class='h3 text-capitalize'>{$eventrow[$j]['EName']}</h2> 
                <p>{$eventDate}</p> 
                <p>{$description}...</p> 
                
                <div class='row  d-flex justify-content-center'>
                <a href='visArrangement.php?id={$eventrow[$j]['EID']}'> 
                <input type='submit' value='Læs mere' class=' btn btn-primary btn-block mr-2 mx-auto text-capitalize'>
                </a> 
                </div>
                </div>
                </div>";
            
            }
                echo "hest";  
        }    
    }
    // else{
    //     for($j = 0; $j < $rowCount; $j++){
    //         $description = $eventrow[$j]['EDescription'];
    //         $description = substr($description,0,90);
    //         $eventDate = date("d-m-Y", strtotime($eventrow[$j]['EDate']));
    //         $eventimages[0] = $eventrow[$j]['EImage'];
    //         echo
    //         "<div class='col-md-4 card text-center mt-5'>
    //         <a href='test.php?id={$eventrow[$j]['EID']}'> 
    //         <img class='img-fluid' src='img/{$eventimages[0]}'>
    //         </a> 
    //         <div class='card-text'>
    //         <h2 class='h3 text-capitalize'>{$eventrow[$j]['EName']}</h2> 
    //         <p>{$eventDate}</p> 
    //         <p>{$description}...</p> 
            
    //         <div class='row  d-flex justify-content-center'>
    //         <a href='visArrangement.php?id={$eventrow[$j]['EID']}'> 
    //         <input type='submit' value='Læs mere' class=' btn btn-primary btn-block mr-2 mx-auto text-capitalize'>
    //         </a> 
    //         </div>
    //         </div>
    //         </div>";
        
    //     }
    // }
    echo $showAll;
    
echo $_SESSION['eventCategory'];
// print_r($eventrow);
   ?>
        </section>
    </main>
</body>
</html>