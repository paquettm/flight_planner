<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/style.css" />

    <title><?=_('Flight Selector')?></title>
</head>
<body>
<div class="container mt-3">
    <h1 class="mb-4"><?=_('Find your next air travel')?>
    <?=$_SESSION['username']??""?></h1>
    <?php
        if(isset($_SESSION['username'])){?>
            <a href='/User/logout?redirect=<?=$_SERVER['REQUEST_URI']?>' class="btn btn-primary">Log out</a>
    <?php    }
    ?>
    <a href='/Flight/TravelPlan' class="btn btn-primary"><?=_('See my current travel plans')?></a>
    <form method="get" action="/Flight/index">
        <div class="row">
            <div class="col-md-6 mb-4">
                <fieldset>
                    <legend class="form-label"><?=_('Where and When')?></legend>
                    <div class="mb-3">
                        <label for="departure" class="form-label"><?=_('From')?></label>
                        <input type="text" name="departure" id="departure" class="form-control" placeholder="Departure airport" value='<?=$departure?>'>
                        <div id="departure-dropdown" class="dropdown-container mb-3"></div>
                    </div>

                    <div class="mb-3">
                        <label for="arrival" class="form-label"><?=_('To')?></label>
                        <input type="text" name="arrival" id="arrival" class="form-control" placeholder="Arrival airport">
                        <div id="arrival-dropdown" class="dropdown-container mb-3"></div>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label"><?=_('Start Date')?></label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="<?=date('Y-m-d')?>" min="<?=date('Y-m-d')?>" max="<?= date('Y-m-d', strtotime('+1 year'))?>">
                    </div>

                    <div class="mb-3">
                        <label for="return_date" class="form-label"><?=_('Return Date')?></label>
                        <input type="date" name="return_date" id="return_date" class="form-control" value="<?=date('Y-m-d')?>" min="<?=date('Y-m-d')?>" max="<?= date('Y-m-d', strtotime('+1 year'))?>">
                    </div>
                </fieldset>
            </div>

            <div class="col-md-6 mb-4">
                <fieldset>
                    <legend class="form-label"><?=_('Options')?></legend>

                    <div class="mb-3">
                        <label for="trip_type" class="form-label"><?=_('Trip type')?></label>
                        <select name="trip_type" id="trip_type" class="form-select">
                            <option value="one_way"><?=_('One Way')?></option>
                            <option value="round_trip"><?=_('Round Trip')?></option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="connections" class="form-label"><?=_('Connections')?></label>
                        <select name="connections" id="connections" class="form-select">
                            <option value="2"><?=_('Up to 2 connections')?></option>
                            <option value="1"><?=_('One connection or direct flights')?></option>
                            <option value="0"><?=_('Direct flights only')?></option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="layover_tolerance" class="form-label"><?=_('Minimum layover time')?></label>
                        <input type="number" name="layover_tolerance" id="layover_tolerance"value="90" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="stopover_tolerance" class="form-label"><?=_('Allow stopovers')?></label>
                        <select name="stopover_tolerance" id="stopover_tolerance" class="form-select">
                            <option value="0"><?=_('No')?></option>
                            <option value="1"><?=_('Yes')?></option>
                        </select>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="d-grid">
            <input type="submit" name="action" value="Search" class="btn btn-primary">
        </div>
    </form>
</div>

    <script type='text/javascript'>
        // Define the function to search for an airport by term
        function searchAirport(term, inputFieldId) {
            fetch(`/Flight/findAirport/${term}`)
                .then(response => response.json()) // Parse the response as JSON
                .then(data => {
                    // Once data is received, display it as a list of suggestions
                    displayAirportList(data, inputFieldId);
                })
                .catch(error => {
                    console.error('Error fetching airport data:', error);
                });
        }

        // Define the function to display the list of airports
        function displayAirportList(airports, inputFieldId) {
            // Get the container where the list of airports will be displayed
            const airportListContainer = document.getElementById(`${inputFieldId}-dropdown`);

            // Clear any previous list
            airportListContainer.innerHTML = '';

            // Create a list of divs for each airport
            airports.forEach(airport => {
                const suggestion = document.createElement('div');
                suggestion.textContent = `${airport.name} (${airport.code}), ${airport.city}`;
                suggestion.classList.add('dropdown-item');

                // Add an event listener to handle airport selection
                suggestion.addEventListener('click', () => {
                    selectAirport(airport, inputFieldId);
                });

                // Append the suggestion to the container
                airportListContainer.appendChild(suggestion);
            });

            // Show the dropdown container
            airportListContainer.style.display = 'block';
        }

        // Function to handle airport selection
        function selectAirport(airport, inputFieldId) {
            // Get the input field
            const inputField = document.getElementById(inputFieldId);
            
            // Set the input field value to the selected airport name and code
            inputField.value = `${airport.code} - ${airport.name}, ${airport.city}`;
            
            // Hide the dropdown list
            const airportListContainer = document.getElementById(`${inputFieldId}-dropdown`);
            airportListContainer.style.display = 'none';
        }

        // Event handler for the 'input' event on the departure and arrival input fields
        function handleInputEvent(event, inputFieldId) {
            // Get the current input value
            const searchTerm = event.target.value;

            // Call the search function if the search term is not empty
            if (searchTerm) {
                searchAirport(searchTerm, inputFieldId);
            } else {
                // Clear the list if the search term is empty
                clearAirportList(inputFieldId);
            }
        }

        // Function to clear the list of airports
        function clearAirportList(inputFieldId) {
            const airportListContainer = document.getElementById(`${inputFieldId}-dropdown`);
            airportListContainer.innerHTML = '';
            airportListContainer.style.display = 'none';
        }

        // Wait for the DOM content to load
        document.addEventListener('DOMContentLoaded', () => {
            // Add event listeners for the 'input' event
            document.getElementById('departure').addEventListener('input', (event) => handleInputEvent(event, 'departure'));
            document.getElementById('arrival').addEventListener('input', (event) => handleInputEvent(event, 'arrival'));
        });
    </script>
        <script type="text/javascript">
        // Function to update the min attribute of return_date based on the selected start_date
        function updateReturnDateMin() {
            // Get the selected start_date value
            const startDate = document.getElementById('start_date').value;
            const returnDateElement = document.getElementById('return_date');

            // Update the min attribute of return_date to match start_date
            returnDateElement.min = startDate;
            if(returnDateElement.value < startDate)
                returnDateElement.value = startDate;

            document.getElementById('return_date').min = startDate;
        }

        // Add an event listener to the start_date input field
        document.getElementById('start_date').addEventListener('change', updateReturnDateMin);
    </script>
</body>
</html>
