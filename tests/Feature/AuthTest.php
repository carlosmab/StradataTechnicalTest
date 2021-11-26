<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function a_user_can_be_registered_by_api()
    {

        $name = "Carlos";
        $email = "carlos@email.com";
        $password = "12345678";

        $response = $this->post('/api/register', ['name' => $name, 'email' => $email, 'password' => $password]);

        $this->assertEquals(1, User::all()->count());

    }
}
