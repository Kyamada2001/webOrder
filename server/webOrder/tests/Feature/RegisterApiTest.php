<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testRegister()
    {
        $data = [
            'username' => 'vuesplash user',
            'email' => 'dummy@email.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
        ];

        $response = $this->json('POST', route('register'), $data);

        //$customer = new Customer();
        $customer = Customer::first();
        $this->assertEquals($data['username'], $customer->username);
        //$this->assertEquals(1,1);

        $response
            ->assertStatus(201)
            ->assertJson(['username' => $customer->username]);
}
}
