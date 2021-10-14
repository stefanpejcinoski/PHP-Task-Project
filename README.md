
## Instructions for project

### Cities

#### Add city

Make a POST request to the application route ```/api/city``` containing the parameter ''name'' the city's name.

#### Get cities

Make a GET request to the application route ```/api/city```

#### Delete city

Make a DELETE request to the application route ```/api/city/{id}``` where id is the city's id.

### Weather 

#### Get weather data for all cities

Make a GET request to the application route ```/api/weather/``` 

### Console commands

#### Retrieve weather for all cities

```php artisan get_weather``` - Calls weather API for all cities stored in database.

#### Retrieve weather for single city

```php artisan get_weather_city city_name``` - Calls weather API for the provided city, the provided city must exist in the database.

### Retrieve weather hourly

The ```get_weather``` command is scheduled to run hourly. Run ```php artisan schedule:work``` or add a cron entry for ```php artisan schedule:run``` to run every minute.
