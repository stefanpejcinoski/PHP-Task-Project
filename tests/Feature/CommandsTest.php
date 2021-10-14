<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Weather;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class CommandsTest extends TestCase
{

    use RefreshDatabase;

    public function test_artisan_get_weather_city_command()
    {
        $this->refreshApplication();
        $city = new City(['name'=>'Skopje']);
        $city->save();
        Artisan::call('get_weather_city', ['city'=>'Skopje']);
        $weather = $city->weather()->latest()->first();
        $this->assertModelExists($weather);
        $this->assertNotNull($weather->temperature);
        $this->assertNotNull($weather->humidity);
        $this->assertNotNull($weather->weather_description);
        $this->assertTrue(Carbon::parse($weather->created_at)>Carbon::now()->subSeconds(30));
        $city->delete();
    }

    public function test_artisan_get_weather_command()
    {
        $this->refreshApplication();
        $test_city1 = new City(['name'=>'Rome']);
        $test_city2 = new City(['name'=>'Belgrade']);
        $test_city3 = new City(['name'=>'Zagreb']);

        $test_city1->save();
        $test_city2->save();
        $test_city3->save();

        Artisan::call('get_weather');

        $weather_test_city1 = $test_city1->weather()->latest()->first();
        $weather_test_city2 = $test_city2->weather()->latest()->first();
        $weather_test_city3 = $test_city3->weather()->latest()->first();

        $this->assertModelExists($weather_test_city1);
        $this->assertNotNull($weather_test_city1->temperature);
        $this->assertNotNull($weather_test_city1->humidity);
        $this->assertNotNull($weather_test_city1->weather_description);
        $this->assertTrue(Carbon::parse($weather_test_city1->created_at)>Carbon::now()->subSeconds(30));

        $this->assertModelExists($weather_test_city2);
        $this->assertNotNull($weather_test_city2->temperature);
        $this->assertNotNull($weather_test_city2->humidity);
        $this->assertNotNull($weather_test_city2->weather_description);
        $this->assertTrue(Carbon::parse($weather_test_city2->created_at)>Carbon::now()->subSeconds(30));$this->assertModelExists($weather_test_city1);

        $this->assertModelExists($weather_test_city3);
        $this->assertNotNull($weather_test_city3->temperature);
        $this->assertNotNull($weather_test_city3->humidity);
        $this->assertNotNull($weather_test_city3->weather_description);
        $this->assertTrue(Carbon::parse($weather_test_city3->created_at)>Carbon::now()->subSeconds(30));
    }

}
