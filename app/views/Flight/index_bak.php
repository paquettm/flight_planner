<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=_('Flight Selector')?></title>

	

</head>
<body>
    <div class="container mt-3">
        <form method="get" action="/Flight/index">
            <div class="row mb-3">
            	<fieldset class="col-12">
                    <legend class="form-label"><?=_('Where and When')?></legend>
	                <div class="col-md-3">
	                    <label for="departure" class="form-label"><?=_('From')?></label>
	                    <input type="text" name="departure" id="departure" class="form-control" placeholder="Departure airport" value='<?=$departure?>'>
	                </div>
	                <div class="col-md-3">
	                    <label for="arrival" class="form-label"><?=_('To')?></label>
	                    <input type="text" name="arrival" id="arrival" class="form-control" placeholder="Arrival airport">
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
                        <input type='number' name='layover_tolerance' value='90' />
                    </div>
                </fieldset>
            </div>
            <div class="d-grid">
                <input type="submit" name="action" value="Search" class="btn btn-primary">
            </div>
        </form>
    </div>
    <div id='airport-list-container'></div>
</body>
</html>
<script type='text/javascript'>
// Define the function to search for an airport by term
function searchAirport(term) {
    fetch(`/Flight/findAirport/${term}`)
        .then(response => response.json()) // Parse the response as JSON
        .then(data => {
            // Once data is received, display it as a list of hyperlinks
            displayAirportList(data);
        })
        .catch(error => {
            console.error('Error fetching airport data:', error);
        });
}

// Define the function to display the list of airports
function displayAirportList(airports) {
    // Get the container where the list of airports will be displayed
    const airportListContainer = document.getElementById('airport-list-container');

    // Clear any previous list
    airportListContainer.innerHTML = '';

    // Create a list of hyperlinks for each airport
    airports.forEach(airport => {
        const link = document.createElement('a');
        link.href = '#'; // Set the href attribute to a placeholder (you can handle this event to select an airport)
        link.textContent = `${airport.name} (${airport.code}), ${airport.city}`;
        
        // You can add an event listener here to handle airport selection
        link.addEventListener('click', (event) => {
            event.preventDefault();
            // Call a function to handle the airport selection (you can pass the airport data if needed)
            selectAirport(airport);
        });

        // Append the link to the container
        airportListContainer.appendChild(link);

        // Add a line break for better display
        airportListContainer.appendChild(document.createElement('br'));
    });
}

// Example function to handle airport selection
function selectAirport(airport) {
    // Implement your logic to handle airport selection
    console.log('Selected airport:', airport);
}

	// Wait for the DOM content to load
document.addEventListener('DOMContentLoaded', () => {
    // Get the departure and arrival input fields
    const departureInput = document.getElementById('departure');
    const arrivalInput = document.getElementById('arrival');

    // Add event listeners for the 'input' event
    departureInput.addEventListener('input', handleDepartureInput);
    arrivalInput.addEventListener('input', handleArrivalInput);
});

// Event handler for the 'input' event on the departure input field
function handleDepartureInput(event) {
    // Get the current input value
    const searchTerm = event.target.value;

    // Call the search function if the search term is not empty
    if (searchTerm) {
        searchAirport(searchTerm);
    } else {
        // Clear the list if the search term is empty
        clearAirportList();
    }
}

// Event handler for the 'input' event on the arrival input field
function handleArrivalInput(event) {
    // Get the current input value
    const searchTerm = event.target.value;

    // Call the search function if the search term is not empty
    if (searchTerm) {
        searchAirport(searchTerm);
    } else {
        // Clear the list if the search term is empty
        clearAirportList();
    }
}

// Function to clear the list of airports
function clearAirportList() {
    const airportListContainer = document.getElementById('airport-list-container');
    airportListContainer.innerHTML = '';
}

</script>