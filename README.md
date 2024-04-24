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

1. Clone the repository from the command line using 
```
git clone https://github.com/paquettm/flight_planner.git
```
2. From the command line navigate to the project folder with the command 
```
cd flight_planner
```
3. Make sure your docker engine is running (maybe start Docker Desktop)
4. From the command line run the command
```
docker run --name myXampp -p 22:22 -p 80:80 -d -v %CD%:/opt/lampp/htdocs tomsik68/xampp
```
Hopefully this also runs on ARM architectures, but this remains untested.
5. Enter the container bash environment with the command
```
docker exec -it myXapp bash
```
6. To install phpenv dependency, run 
```
../bin/php composer.phar install
```
7. Run 
```
composer dump-autoload
```
8. Create a .env file in the project base directory with your database connection information as follows, e.g.,:
```
db_host="localhost"
db_user="root"
db_pass=""
db_name="flight_data"
```
9. Point your browser to localhost/phpmyadmin.
10. Import the `flight_data.sql` file from the project folder.
11. Point your browser to localhost and use the application.

# TODO
So many things to do, so little time:

- i18n is deactivated. Needs to be done for the environment. Validate i18n and perform l10n.
- Apply the following SQL to lat/long data with results from geocoding.
```
SELECT latitude, longitude, SQRT(
    POW(69.1 * (latitude - [startlat]), 2) +
    POW(69.1 * ([startlng] - longitude) * COS(latitude / 57.3), 2)) AS distance
FROM TableName HAVING distance < 25 ORDER BY distance;
```
- Add maps (leaflet?)
- Actual semblance of transactions when confirming flight sets.