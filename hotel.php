<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>php-hotel</title>
</head>

<body>
<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

$ResearchArray=[];

?>

    <form action="hotel.php" class="d-flex justify-content-center align-content-center m-1 gap-1" method="get">
        <input type="text" name="search" placeholder="Cerca un hotel" class="w-50 ">

        <input type="radio" id="parking" name="parking" value="true">
        <label for="parking">Con Parcheggio</label>
        <input type="radio" id="noparking" name="parking" value="false" checked>
        <label for="parking">Con o senza parcheggio</label>

        <select name="ordina" id="order">
            <option value="1">1 stella</option>
            <option value="2">2 stelle</option>
            <option value="3">3 stelle</option>
            <option value="4">4 stelle</option>
            <option value="5">5 stelle</option>
        </select>

        <input type="submit">
    </form>

    <?php 
    $searchWord = $_GET['search'];
    $isParking = $_GET['parking'];
    $order = $_GET['ordina'];
    echo "Risultati per '" . ($searchWord != '' ? $searchWord : '') . ($isParking== 'true' ? "' con parcheggio" : "' con e senza parcheggio") . " che hanno minimo ". $order . " stelle";
    



    for($i=0; $i < count($hotels); $i++){
        if(str_contains(strtolower($hotels[$i]['name']), strtolower($searchWord))){

            if($isParking == 'true'){
                if($hotels[$i]['parking']){

                    if($hotels[$i]['vote'] >= $order){
                        array_push($ResearchArray, $hotels[$i]);

                    }

                }

            }else{

                if($hotels[$i]['vote'] >= $order){
                    array_push($ResearchArray, $hotels[$i]);

                }
              
            }
        }

    }

    
        ?>

    <div class="content">
        <h1>Risultati:</h1>

        <table class="w-100">
            <thead>
                <th>Nome Hotel</th>
                <th>Descrizione</th>
                <th>Parcheggio</th>
                <th>Voto</th>
                <th>Distanza dal centro</th>
            </thead>
            <tbody>

            <?php 
            
            foreach($ResearchArray as $chiave => $valore){
                echo "<tr>"
                . "<td>". $valore['name'] . "</td>"
                . "<td col=2>". $valore['description'] . "</td>"
                . "<td>". ($valore['parking'] ? 'Si' : 'No') . "</td>"
                . "<td>". $valore['vote'] . "/5" . "</td>"
                . "<td>". $valore['distance_to_center'] ." km" . "</td>"
                ."</tr>";
            };

            ?>

    
            </tbody>
        </table>
    </div>



</body>

</html>