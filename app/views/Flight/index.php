<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flight Selector</title>
</head>
<body>
    <div class="container mt-3">
        <form method="get" action="/Flight/index">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="departure" class="form-label">From</label>
                    <input type="text" name="departure" id="departure" class="form-control" placeholder="Departure city">
                </div>
                <div class="col-md-6">
                    <label for="arrival" class="form-label">To</label>
                    <input type="text" name="arrival" id="arrival" class="form-control" placeholder="Arrival city">
                </div>
            </div>
            <div class="row mb-3">
                <fieldset class="col-12">
                    <legend class="form-label">Travel options</legend>
                    <div class="mb-3">
                        <label for="trip_type" class="form-label">Trip type</label>
                        <select name="trip_type" id="trip_type" class="form-select">
                            <option value="one_way">One Way</option>
                            <option value="round_trip">Round Trip</option>
                            <option value="open_jaw">Open Jaw</option>
                            <option value="multi_city">Multi-city</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="connections" class="form-label">Number of connections</label>
                        <select name="connections" id="connections" class="form-select">
                            <option value="0">Direct flights only</option>
                            <option value="1">One connection or direct flights</option>
                            <option value="2">Up to 2 connections</option>
                        </select>
                    </div>
                </fieldset>
            </div>
            <div class="d-grid">
                <input type="submit" name="action" value="Search" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>
