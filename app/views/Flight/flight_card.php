            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?=_('Trip')?></h5>
                    <div class="row">
                        <div class="col-md-3"><strong><?=_('Total Price: $')?></strong><?= number_format($trip->total_price, 2)?></div>
                        <div class="col-md-3"><strong><?=_('Number of Flights: ')?></strong><?= count($trip->flights)?></div>
                        <div class="col-md-3"><strong><?=_('Total Trip Time: ')?></strong>
                            <?php
                     [$total_trip_time,$total_flight_time] = \app\models\Flight::tripTime($trip->flights, '2024-01-01');
                     echo ($total_trip_time->d>0?$total_trip_time->format(_('%d days, %Hh%Im')):$total_trip_time->format(_('%Hh%Im')));
                 ?></div>
                        <div class="col-md-3"><strong><?= 'Total Flight Time: '?></strong>
                            <?= ($total_flight_time->d>0?$total_flight_time->format(_('%d days, %Hh%Im')):$total_flight_time->format(_('%Hh%Im')))?></div>
                </div>
                    <!-- Display each flight in the trip -->
                    <?php
                        $count = count($trip->flights); 
                        foreach ($trip->flights as $index => $flight): ?>
                        <div class="row">
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
                                    [$flight_time,$arrival_time] = \app\models\Flight::flightTime($flight, '2024-01-01');
                                    echo $flight_time->format('%H hours, %i minutes');
                                ?>
                            </div>
                            <div class="col-md-3">
                                <strong><?=_('Arrival Time:')?></strong> <?= $arrival_time->format('Y-m-d H:i ');
                                ?>
                            </div>
                        </div>
                         <!-- Add horizontal rule to separate flights -->
                        <?= ($index < $count - 1?'<hr>':'')?>
                    <?php endforeach; ?>
                </div>
                <div class="card-footer">
                    <!-- Add a button to select the trip -->
                    <a href='/Flight/selectTrip?flights=<?= \app\daos\Flight::flightKeys($trip) ?>' class="btn btn-primary"><?=_('Select Trip')?></a>
                </div>
            </div>
