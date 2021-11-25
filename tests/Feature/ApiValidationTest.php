<?php

namespace Tests\Feature;

use App\Models\PublicPerson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiValidationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */

    public function user_can_get_matching_names_from_api()
    {

        $this->withoutExceptionHandling();

        $name = "Jorge Rodriguez";
        $matchRate = 100;

        PublicPerson::factory()->count(5)->create();
        PublicPerson::factory()->create(['name' => $name]);

        $response = $this->post("/api/validate", ['name' => $name, 'match_rate' => $matchRate]);

        $response->assertJsonCount(1)
            ->assertJson( [
                'data' => [
                [
                    'data' => [
                        'name' => $name,
                        'match_rate' => $matchRate
                    ]
                ]
            ]
        ]);

    }
}
