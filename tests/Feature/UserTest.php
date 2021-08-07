<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getUser()
    {
        $this->seed();

        $this->withoutExceptionHandling();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->json('GET','/api/customer');
        $response->assertStatus(200);


    }

    //error
//    public function test_createUser()
//    {
//        $this->seed('DatabaseSeeder');
//
//        $this->withoutExceptionHandling();
//
//        $response = $this->json('POST','/api/register',[
//            'email' => 'testing@mail.com',
//            'password' => 'dummydummy',
//            'user_type_id' => 1
//        ]);
//        $response->assertStatus(200);
//    }
}
