# PHP_MVC_Framework

Example simple PHP MVC Framework used in class to present the principles of PHP MVC Frameworks in a simplified way.

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
