<?php

namespace Tests\Unit;

use App\Models\PublicPerson;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NameValidationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * Testing if a method in PublicPerson class (model) can
     * validate a name given a match rating
     *
     * @return void
     */
    public function method_can_return_matching_names()
    {
        $name = "Jorge Rodriguez";
        $matchRate = 100;

        PublicPerson::factory()->count(10)->create();
        PublicPerson::factory()->create(['name' => $name]);


        $matchingNames = PublicPerson::getMatchingNames($name, $matchRate);

        $this->assertEquals(1,$matchingNames->count());

    }

    /**
     * @test
     *
     * Testing if the validation method is case insensitive
     *
     *
     * @return void
     */

    public function method_is_case_insensitive()
    {

        $name = "Jorge Rodriguez";
        $matchRate = 100;

        PublicPerson::factory()->create(['name' => "JORGE RODRIGUEZ"]);

        $matchingNames = PublicPerson::getMatchingNames($name, $matchRate);

        $this->assertEquals(1,$matchingNames->count());

    }

    /**
     * @test
     *
     * Testing if the validation method is case insensitive
     *
     *
     * @return void
     */

    public function method_can_omit_special_characters()
    {

        $name = "Jorge Rodriguez";
        $matchRate = 100;

        PublicPerson::factory()->create(['name' => "Jor%ge ..Rodr@ig/uez"]);

        $matchingNames = PublicPerson::getMatchingNames($name, $matchRate);

        $this->assertEquals(1,$matchingNames->count());

    }

    /**
     * @test
     *
     * Testing if the validation method omits phonetic match
     *
     *
     * @return void
     */

    public function method_can_omit_phonetic_match()
    {

        $name = "Cielo Alexandra Rodriguez";
        $matchRate = 100;

        PublicPerson::factory()->create(['name' => "Sielo Alecsandra Rodriguez"]);

        $matchingNames = PublicPerson::getMatchingNames($name, $matchRate);

        $this->assertEquals(1,$matchingNames->count());

    }


    
}
