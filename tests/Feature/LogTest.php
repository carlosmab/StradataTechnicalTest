<?php

namespace Tests\Feature;

use App\Models\PublicPerson;
use App\Models\Query;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertJson;

class LogTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function query_can_be_fetched_by_uuid()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create(['password' =>  bcrypt('12345678')]);
        $res = $this->post('/api/login', ['email' => $user->email, 'password' => '12345678' ]);

        $token = $res['token'];

        $name = "Jorge Rodriguez";
        $matchRate = 100;

        PublicPerson::factory()->count(2)->create(['name' => $name]);

        $this->post("/api/validate", ['searched_name' => $name, 'match_rate' => $matchRate], ['HTTP_Authorization' => 'Bearer '.$token]);

        $query = Query::first();

        $response = $this->get("/api/logs/" . $query->uuid, ['HTTP_Authorization' => 'Bearer '.$token]);

        $response->assertJson([
                'data' => [
                    'uuid' => $query->uuid,
                    'searched_name' => $name,
                    'match_rate' => $matchRate
                ]
            ]);
    }
}
