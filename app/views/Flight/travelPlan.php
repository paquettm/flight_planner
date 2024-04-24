<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/style.css" />
    <title><?=_('Travel Plan')?></title>
</head>
<body>
<?php
function redeyeClass($flight){
    if($flight->departure_time>$flight->arrival_time)
        return (" bg-warning");
    else
        return "";
}
?>
    <div class="container mt-4">
        <h1><?=_('Your travel plans')?>
        <?=$_SESSION['username']??"<a href='/User/index?redirect=$_SERVER[REQUEST_URI]' class='btn btn-primary'>Log in to see your saved data</a>"?></h1>
        <?php
        if(isset($_SESSION['username'])){?>
            <a href='/User/logout?redirect=<?=$_SERVER['REQUEST_URI']?>' class="btn btn-primary">Log out</a>
        <?php    }
        ?>
        <p>Flights that fly through the night are highlighted in yellow.</p>
        <p>Add more segments to your travel by pressing "Travel from here" next to a set of flights</p>
        <h2><?=_('Planned trips')?></h2> <a href='/Flight/index' class="btn btn-primary"><?=_('Add more travel')?></a>
        <!-- Loop through trips array -->
        <?php 
        if(count($planned_trips) == 0){?>
        <p>No trips in your cart</p>
        <?php }
        foreach ($planned_trips as  $trip){
            [$trip->flights,$trip->total_price] = $trip->getFlights();
            $this->view('Flight/travel_card',['trip'=>$trip]);
        } 
        ?>
    </div>
    <div class="container mt-4">
        <h2><?=_('Confirmed trips')?></h2>
        <!-- Loop through trips array -->
        <?php 
        if(count($confirmed_trips) == 0){?>
        <p>No trips confirmed yet!</p>
        <?php }
        foreach ($confirmed_trips as  $trip){
            [$trip->flights,$trip->total_price] = $trip->getFlights();
            $this->view('Flight/travel_card',['trip'=>$trip]);
        } 
        ?>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>