# Flight planner

Example application to plan trips using air transportation.
Rules:
- An airline has a name and is identified by a IATA Airline Code. Ex: Air Canada (AC)
- An airport is a location identified by a IATA Airport Code. It also has a name, a city, latitude and longitude coordinates, a timezone and a city code, the IATA Airport Code for a city, which may differ from an airport code in larger areas. Ex: Pierre Elliott Trudeau International (YUL) belongs to the Montreal (YMQ) city code.
- A flight is uniquely numbered for a referenced airline. For the sake of simplicity, **a flight is priced for a single passenger (any gender, any type) in a neutral currency and is available every day of the week**. It references a pair of airports for departure and arrival. It has departure and arrival times **in the corresponding airport timezones**. Ex: AC301 from YUL to YVR departs at 7:35 AM (Montreal) and arrives at 10:05 AM (Vancouver).

Assumptions (beyond those in **bold** in the rules above):
- Travelers do not have ovenight layovers; connections happen between 00:00 and 23:59 (local time).
- Travelers set their layover tolerance.
- Ultra long-haul flights last less than 24 hours (elapsed on plane) and more than 0 smallest time unit.

## Installation

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

5. Localistions will only work if the locale installed on the computer matches the locale name in the folder under locale. Ours is 'en'. To know which locale you are running on your computer run
```
echo Locale::getDefault();
```
as commented in the root index.php.

##Windows extras

GnuWin32 tools to find files and to extract gettext call keys are required for i18n and l10n.

1. Download and install gettext tools from the main installer at http://gnuwin32.sourceforge.net/packages/gettext.htm
2. Download and install find utilities from the main installer at http://gnuwin32.sourceforge.net/packages/findutils.htm

You will then be able to run "find ./app/views -type f -exec xgettext -j {} ;" to extract all gettext calls in views to a messages.po file in the main project folder.
