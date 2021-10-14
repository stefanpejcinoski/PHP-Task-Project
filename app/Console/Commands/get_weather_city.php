<?php

namespace App\Console\Commands;

use App\Models\City;
use Illuminate\Console\Command;
use App\Http\Controllers\WeatherController;
class get_weather_city extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get_weather_city {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $city = City::where('name', $this->argument('city'))->firstOrFail();
        $this->info("Getting weather for ".$city->name);
        $controller = app(WeatherController::class);
        $controller->getWeatherFromAPI($city);
    }
}
