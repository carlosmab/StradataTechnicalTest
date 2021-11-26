<?php

namespace Tests\Unit;

use App\Models\PublicPerson;
use App\Models\Query;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QueryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function a_query_can_be_related_to_many_people()
    {
        $name = "Jorge Rodriguez";
        $matchRate = 100;

        PublicPerson::factory()->count(10)->create(['name' => $name]);

        $people = PublicPerson::getMatchingNames($name, $matchRate);

        $query = Query::factory()->create();

        foreach($people as $person) {
            $query->results()->attach($person, ['match_rate' => $person->matchRate]);
        }

        $this->assertEquals(10,$query->results()->count());
    }
}
