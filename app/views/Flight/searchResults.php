<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/style.css" />
    <title><?=_('Flight Selector')?></title>
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
        <h1><?=_('Your searched flights')?></h1>
        <p>Flights that fly through the night are highlighted in yellow.</p>
        <p>These are the search results for flights leaving on <strong><?= $start_date ?></strong> from <strong><?=$departure_airport?></strong> and going to <strong><?=$arrival_airport?></strong>, according to your travel options.</p>
        <p>Note that the flights are sorted with least expensive trajectories first.</p>
        <a href='/Flight/index' class="btn btn-primary"><?=_('Start a new search')?></a>
        <h2><?=_('Available Trips')?></h2>
        <p>Please select your <strong><?= $trip_type ?></strong> travel choice.</h3>
        </p>
        <!-- Loop through trips array -->
        <?php 
        foreach ($trips as  $trip){
            $trip->start_date = $start_date;
            $this->view('Flight/flight_card',['trip'=>$trip]);
        } 
        ?>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>