<?php

namespace Tests\Feature;

use App\Models\PublicPerson;
use App\Models\Query;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ApiValidationTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     *
     * @return void
     */

    public function unauthenticated_user_cant_get_validated_data()
    {

        $this->withoutExceptionHandling();

        $name = "Jorge Rodriguez";
        $matchRate = 100;

        $response = $this->post("/api/validate", ['searched_name' => $name, 'match_rate' => $matchRate]);

        $this->assertEquals(0, Query::all()->count());
        $response->assertStatus(Response::HTTP_FORBIDDEN);

    }



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
        PublicPerson::factory()->count(2)->create(['name' => $name]);

        $response = $this->post("/api/validate", ['searched_name' => $name, 'match_rate' => $matchRate]);

        $response->assertJsonCount(1)
            ->assertJson( [
                'data' => [
                    'results' => [
                        [
                            'name' => $name,
                            'match_rate' => $matchRate
                        ],
                        [
                            'name' => $name,
                            'match_rate' => $matchRate
                        ],
                    ]
                ]
            ]);
    }

}
