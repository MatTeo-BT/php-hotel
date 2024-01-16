<!-- Partiamo da questo array di hotel. https://www.codepile.net/pile/OEWY7Q1G Stampare tutti i nostri hotel con tutti i dati disponibili.
Iniziate in modo graduale.
Prima stampate in pagina i dati, senza preoccuparvi dello stile.
Dopo aggiungete Bootstrap e mostrate le informazioni con una tabella.
Bonus:
1 - Aggiungere un form ad inizio pagina che tramite una richiesta GET permetta di filtrare gli hotel che hanno un parcheggio.
2 - Aggiungere un secondo campo al form che permetta di filtrare gli hotel per voto (es. inserisco 3 ed ottengo tutti gli hotel che hanno un voto di tre stelle o superiore)
NOTA:
deve essere possibile utilizzare entrambi i filtri contemporaneamente (es. ottenere una lista con hotel che dispongono di parcheggio e che hanno un voto di tre stelle o superiore)
Se non viene specificato nessun filtro, visualizzare come in precedenza tutti gli hotel. -->
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
$parkingFilter = (isset($_GET['parking'])) && $_GET['parking'] == 1 ? true : false;


$finalHotels = $hotels;

if ((isset($_GET['parking'])) && $_GET['parking'] == 1) {
    $temporaryArray = [];

    foreach ($finalHotels as $hotel) {
        if ($hotel['parking'] === true) {
            $temporaryArray[] = $hotel;
        }
    }

    $finalHotels = $temporaryArray;
}

if ((isset($_GET['vote'])) && $_GET['vote'] != 0 && is_numeric($_GET['vote'])) {
    $temporaryArray = [];

    foreach ($finalHotels as $hotel) {
        if ($hotel['vote'] >= $_GET['vote']) {
            $temporaryArray[] = $hotel;
        }
    }

    $finalHotels = $temporaryArray;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <main>
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Parking</th>
                    <th>Vote</th>
                    <th>Distance to center</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($hotels as $hotel) { ?>
                <tr>
                    <td> <?php echo $hotel['name'] ?></td>
                    <td> <?php echo $hotel['description'] ?></td>
                    <td> <?php if ($hotel['parking'] === true) {
                                    echo 'Parcheggio disponibile: si';
                                } else {
                                    echo 'Parcheggio disponibile: no';
                                } ?></td>
                    <td> <?php echo $hotel['vote'] ?></td>
                    <td> <?php echo $hotel['distance_to_center'] . ' km' ?></td>


                </tr>
            </tbody>
            <?php } ?>
        </table>
        <div class="container">
            <div class="row">
                <form action="./index.php" method="GET">
                    <div class="mb-3 form-check w-100">
                        <select class="form-select mb-2" aria-label="Default select example" id="vote" name="vote">
                            <option selected value="0">Select minimum rating</option>
                            <option value="1">One star</option>
                            <option value="2">Two stars</option>
                            <option value="3">Three stars</option>
                            <option value="4">Four stars</option>
                            <option value="5">Five stars</option>
                        </select>
                    </div>
                    <div class="mb-3 form-check w-100">
                        <select class="form-select mb-2" aria-label="Default select example" id="parking"
                            name="parking">
                            <option selected value="2">Select parking</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        <button type="submit" class="btn btn-primary ms-auto">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </main>
</body>

</html>