<!DOCTYPE html>
<html>

<head>
    <title>Flight Selector</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="container mt-4">
        <h2>Available Trips</h2>
        
        <!-- Loop through trips array -->
        <?php foreach ($trips as  $trip): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Trip</h5>
                    <p class="card-text">Total Price: $<?php echo number_format($trip->total_price, 2); ?></p>
                    <p class="card-text">Number of Flights: <?php echo count($trip->flights); ?></p>
                    <!-- Display each flight in the trip -->
                    <?php foreach ($trip->flights as $index => $flight): ?>
                        <div class="row">
                            <div class="col-md-3">
                                <strong>Flight:</strong> <?php echo $flight->airline . " " . $flight->number; ?>
                            </div>
                            <div class="col-md-3">
                                <strong>From:</strong> <?php echo $flight->departure_airport . " at " . $flight->departure_time; ?>
                            </div>
                            <div class="col-md-3">
                                <strong>To:</strong> <?php echo $flight->arrival_airport . " at " . $flight->arrival_time; ?>
                            </div>
                            <div class="col-md-3">
                                <strong>Price:</strong> $<?php echo number_format($flight->price, 2); ?>
                            </div>
                        </div>
                         <!-- Add horizontal rule to separate flights -->
                        <?php if ($index < count($trip->flights) - 1): ?>
                            <hr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="card-footer">
                    <!-- Add a button to select the trip -->
                    <a href='/Flight/selectTrip?flights=<?= \app\daos\Flight::flightKeys($trip) ?>' class="btn btn-primary">Select Trip</a>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>