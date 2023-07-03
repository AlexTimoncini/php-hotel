<?php
    $originalHotels = [
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
    $hotels = $originalHotels;
    $parking = $_GET['parkingFilter'];
    $vote = intval($_GET['voteRadio']);

    if ($parking === '0') {
        $hotels = array_filter(array_filter($originalHotels, 
            function($hotel){
                return $hotel['parking'] === false;
            }), function($hotel) use ($vote){return $hotel['vote'] >= $vote;});
    } elseif ($parking === '1'){
        $hotels = array_filter(array_filter($originalHotels, function($hotel){return $hotel['parking'] === true;}), function($hotel) use ($vote){return $hotel['vote'] >= $vote;});
    } else {
        $hotels = array_filter($originalHotels, function($hotel) use ($vote){return $hotel['vote'] >= $vote;});
    };


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hotel? Boo-Le-An</title>
</head>
<body>
    <form action="./index.php" method="GET" class="m-4">
        <div class="wrapper">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="parkingFilter" id="parking_und" value="2" checked>
                <label class="form-check-label text-primary" for="parking_und">
                    All Result
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="parkingFilter" id="parking_false" value="0">
                <label class="form-check-label text-danger" for="parking_false">
                    Parking not avaible
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="parkingFilter" id="parking_true" value="1">
                <label class="form-check-label text-success" for="parking_true">
                    Parking avaible
                </label>
            </div>
        </div>
        <div class="wrapper mt-5">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="voteRadio" id="voteAll" value="0" checked>
                <label class="form-check-label text-primary" for="voteAll">
                    0+
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="voteRadio" id="parking_false" value="2">
                <label class="form-check-label text-warning" for="vote_all">
                    2+
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="voteRadio" id="parking_true" value="4">
                <label class="form-check-label text-success" for="parking_true">
                    4+
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-primary mt-4">Filter</button>
    </form>
    <h2 class="ps-2">
        <?php if($parking === '0'){ 
                echo 'Without Parking'; 
            }elseif($parking === '1'){
                echo 'With Parking';
            }else{
                echo 'All Result';
            };?>
            --
        <?php echo $vote . '+'?>
    </h2>
    <div class="ivy_cards d-flex justify-content-center">
        <?php foreach($hotels as $hotel) { ?>
            <div class="card text-center m-2 flex-grow-1">
                <div class="card-header">
                    <?php echo $hotel['name'] ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-warning">
                        <?php for ($i = 0; $i < $hotel['vote']; $i++) { ?>
                            <span> <i class="fa-solid fa-star"></i> </span>
                        <?php   } ?>
                        <?php for ($i = 0; $i < (5 - $hotel['vote']); $i++) { ?>
                            <span> <i class="fa-regular fa-star"></i> </span>
                        <?php   } ?>
                    </h5>
                    <p class="card-text"><?php echo $hotel['description'] ?></p>
                    <p class="card-text">
                        <?php if ($hotel['parking']) { ?>
                            <span class="text-success"><i class="fa-solid fa-square-parking fa-2x"></i></span>
                        <?php } ?>
                    </p>
                </div>
                    <div class="card-footer text-muted">
                        <?php echo $hotel['distance_to_center'] ?> km from center
                    </div>
                </div>
        <?php } ?>
    </div>
</body>
</html>