<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

//        $response = $this->getJson('/keda_interview-master/public/api/customer');
        $response = $this->withHeaders([
            'X-Requested-With' => 'XMLHttpRequest',
            'Authorization' => 'Bearer 2|V0kjh7iDx7R8YFqONVdKgBv1T0ZXWODoTL4LewR7'
        ])->get('/keda_interview-master/public/api/customer');

        $response->assertStatus(200);
//
//        $response->assertStatus(200);
//        $this->json('GET',route())

    }
}
