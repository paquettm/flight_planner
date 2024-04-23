<!DOCTYPE html>
<html>
<head>
    <title><?=_('Travel Plan')?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container mt-4">
        <h2><?=_('Planned trips')?></h2> <a href='/Flight/index' class="btn btn-primary"><?=_('Add more travel')?></a>
        <!-- Loop through trips array -->
        <?php 
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