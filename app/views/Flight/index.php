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
    <title><?=_('Flight Selector')?></title>

    <!-- Custom CSS for dropdown container -->
    <style>
        /* Dropdown container */
        .dropdown-container {
            position: absolute;
            z-index: 1000;
            background-color: white;
            border: 1px solid #ccc;
            width: 100%; /* Match the input width */
            max-height: 200px;
            overflow-y: auto;
            display: none; /* Initially hidden */
        }

        /* Dropdown container item */
        .dropdown-item {
            padding: 8px;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="container mt-3">
        <form method="get" action="/Flight/index">
            <div class="row mb-3">
                <fieldset class="col-12">
                    <legend class="form-label"><?=_('Where and When')?></legend>
                    <div class="col-md-3 position-relative">
                        <label for="departure" class="form-label"><?=_('From')?></label>
                        <input type="text" name="departure" id="departure" class="form-control" placeholder="Departure airport" value='<?=$departure?>'>
                        <div id="departure-dropdown" class="dropdown-container"></div>
                    </div>
                    <div class="col-md-3 position-relative">
                        <label for="arrival" class="form-label"><?=_('To')?></label>
                        <input type="text" name="arrival" id="arrival" class="form-control" placeholder="Arrival airport">
                        <div id="arrival-dropdown" class="dropdown-container"></div>
                    </div>
                    <div class="col-md-3">
                        <label for="start_date" class="form-label"><?=_('Travel Start Date:')?></label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="<?=date('Y-m-d')?>" min="<?=date('Y-m-d')?>" max="<?= date('Y-m-d', strtotime('+1 year'))?>">
                    </div>
                    <div class="col-md-3">
                        <label for="return_date" class="form-label"><?=_('Travel Start Date:')?></label>
                        <input type="date" name="return_date" id="return_date" class="form-control" value="<?=date('Y-m-d')?>" min="<?=date('Y-m-d')?>" max="<?= date('Y-m-d', strtotime('+1 year'))?>">
                    </div>
                </fieldset>
            </div>
            <div class="row mb-3">
                <fieldset class="col-12">
                    <legend class="form-label"><?=_('Travel options')?></legend>
                    <div class="mb-3">
                        <label for="trip_type" class="form-label"><?=_('Trip type')?></label>
                        <select name="trip_type" id="trip_type" class="form-select">
                            <option value="one_way"><?=_('One Way')?></option>
                            <option value="round_trip"><?=_('Round Trip')?></option>
                            <option value="open_jaw"><?=_('Open Jaw')?></option>
                            <option value="multi_city"><?=_('Multi-city')?></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="connections" class="form-label"><?=_('Number of connections')?></label>
                        <select name="connections" id="connections" class="form-select">
                            <option value="0"><?=_('Direct flights only')?></option>
                            <option value="1"><?=_('One connection or direct flights')?></option>
                            <option value="2"><?=_('Up to 2 connections')?></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="layover_tolerance" class="form-label"><?=_('Minimum time between flights')?></label>
                        <input type='number' name='layover_tolerance' value='90' class='form-control' />
                    </div>
                </fieldset>
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
</body>
</html>
