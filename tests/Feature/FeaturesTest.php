<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Weather;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeaturesTest extends TestCase
{

    use RefreshDatabase;

    public function test_create_cities()
    {

        $this->refreshApplication();
        $city = ['name'=>'Skopje'];
        $this->post('/api/city', $city);
        $cityModel = City::where('name', 'Skopje')->first();
        $this->assertModelExists($cityModel);
    }

    public function test_name_required()
    {
        $this->refreshApplication();
        $response = $this->post('/api/city');
        $response->assertSessionHasErrors('name');
    }

    public function test_name_length_not_zero()
    {
        $this->refreshApplication();
        $response = $this->post('/api/city', ['name'=>'']);
        $response->assertSessionHasErrors('name');
    }

    public function test_city_name_unique()
    {
        $this->refreshApplication();

        $this->post('/api/city', ['name'=>'Skopje']);
        $response = $this->post('/api/city', ['name'=>'Skopje']);
        $response->assertSessionHasErrors('name');
    }


}
