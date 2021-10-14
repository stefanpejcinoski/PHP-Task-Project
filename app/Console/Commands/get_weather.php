<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\WeatherController;
class get_weather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get_weather';
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

        $cities = City::all();
        $controller = app(WeatherController::class);
        $cities->each(function ($city) use($controller) {
            $this->info("Getting weather for ".$city->name);
            $controller->getWeatherFromAPI($city);
        });

    }


}
