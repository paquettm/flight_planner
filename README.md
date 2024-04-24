# Flight planner

Example application to plan trips using air transportation.
Rules:
- An airline has a name and is identified by a IATA Airline Code. Ex: Air Canada (AC)
- An airport is a location identified by a IATA Airport Code. It also has a name, a city, latitude and longitude coordinates, a timezone and a city code, the IATA Airport Code for a city, which may differ from an airport code in larger areas. Ex: Pierre Elliott Trudeau International (YUL) belongs to the Montreal (YMQ) city code.
- A flight is uniquely numbered for a referenced airline. For the sake of simplicity, **a flight is priced for a single passenger (any gender, any type) in a neutral currency and is available every day of the week**. It references a pair of airports for departure and arrival. It has departure and arrival times **in the corresponding airport timezones**. Ex: AC301 from YUL to YVR departs at 7:35 AM (Montreal) and arrives at 10:05 AM (Vancouver).

Assumptions (beyond those in **bold** in the rules above):
- Travelers do not have overnight layovers unless they choose the stopover option.
- Travelers set their layover tolerance; some can tolerate short connection times and others find it stressful.
- Ultra long-haul flights last less than 24 hours (elapsed on plane) and more than 0 smallest time unit.

## Setup

1. Clone the repository
2. Run `composer install`
3. Run `composer dump-autoload`
4. Create a .env file in the project base directory with your database connection information as follows, e.g.,:
```
db_host="localhost"
db_user="applicationDBUser"
db_pass="applicationDBUserPassword"
db_name="applicationDBName"
```

# TODO
- i18n is deactivated. Needs to be done for the environment. Validate i18n and perform l10n.
- Apply the following SQL to lat/long data with results from geocoding.
```
SELECT latitude, longitude, SQRT(
    POW(69.1 * (latitude - [startlat]), 2) +
    POW(69.1 * ([startlng] - longitude) * COS(latitude / 57.3), 2)) AS distance
FROM TableName HAVING distance < 25 ORDER BY distance;
```
