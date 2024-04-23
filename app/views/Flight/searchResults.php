<!DOCTYPE html>
<html>
<head>
    <title><?=_('Flight Selector')?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container mt-4">
        <h2><?=_('Available Trips')?></h2> 
        <!-- Loop through trips array -->
        <?php 
        foreach ($trips as  $trip){
            $this->view('Flight/flight_card',['trip'=>$trip]);
        } 
        ?>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>