            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?=_('Trip')?></h5>
                    
                    <!-- Display each flight in the trip -->
                    <?php
                        $count = count($trip->flights); 
                        foreach ($trip->flights as $index => $flight): ?>
                        <div class="row<?=redeyeClass($flight)?>">
                            <div class="col-md-3">
                                <strong><?=_('Flight:')?></strong> <?=$flight->airline . " " . $flight->number?>
                            </div>
                            <div class="col-md-3">
                                <strong><?=_('From:')?></strong> <?= $flight->departure_airport . _(' at ') . $flight->departure_time ?>
                            </div>
                            <div class="col-md-3">
                                <strong><?=_('To:')?></strong> <?= $flight->arrival_airport . _(' at ') . $flight->arrival_time ?>
                            </div>
                            <div class="col-md-3">
                                <strong><?=_('Price:')?></strong> $<?= number_format($flight->price, 2) ?>
                            </div>
                            <div class="col-md-3">
                                <strong><?=_('Flight Duration:')?></strong> <?php
                                    [$flight_time,$arrival_time] = \app\models\Flight::flightTime($flight, $trip->start_date);
                                    echo $flight_time->format('%H hours, %i minutes');
                                ?>
                            </div>
                            <div class="col-md-3">
                                <strong><?=_('Arrival Time:')?></strong> <?= $arrival_time->format('Y-m-d H:i ');
                                ?>
                            </div>
                        </div>
                         <!-- Add horizontal rule to separate flights -->
                        <hr>
                    <?php endforeach; ?>
                    <div class="row">
                        <div class="col-md-3"><strong><?=_('Total Price: $')?></strong><?= number_format($trip->total_price, 2)?></div>
                        <div class="col-md-3"><strong><?=_('Number of Flights: ')?></strong><?= count($trip->flights)?></div>
                        <div class="col-md-3"><strong><?=_('Total Trip Time: ')?></strong>
                            <?php
                     [$total_trip_time,$total_flight_time] = \app\models\Flight::tripTime($trip->flights, $trip->start_date);
                     echo ($total_trip_time->d>0?$total_trip_time->format(_('%d days, %Hh%Im')):$total_trip_time->format(_('%Hh%Im')));
                 ?></div>
                        <div class="col-md-3"><strong><?= 'Total Flight Time: '?></strong>
                            <?= ($total_flight_time->d>0?$total_flight_time->format(_('%d days, %Hh%Im')):$total_flight_time->format(_('%Hh%Im')))?></div>
                </div>
                
                </div>
                <div class="card-footer">
                    <!-- Add a button to select the trip -->
                    <a href='/Flight/index?start_airport=<?= $trip->getArrival() ?>&start_date=<?=$trip->start_date?>' class="btn btn-danger"><?=_('Travel from here')?></a>
                    <a href='/Flight/deleteTrip?flights=<?= $trip->flightKeys() ?>&start_date=<?=$trip->start_date?>' class="btn btn-danger"><?=_('Delete Trip')?></a>
                    <a href='/Flight/confirmTrip?flights=<?= $trip->flightKeys() ?>&start_date=<?=$trip->start_date?>' class="btn btn-success"><?=_('Confirm Trip')?></a>
                </div>
            </div>
