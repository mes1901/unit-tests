<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientApiTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testCreateClient()
    {
        $expectedData = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ];

        $this->post('api/clients', $expectedData)
            ->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'first_name',
                'last_name',
                'email',
                'created_at',
                'updated_at',
            ]);
    }

    public function testGetClient()
    {
        $client = factory(Client::class)->create();

        $this->get('api/clients/'.$client->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'first_name',
                'last_name',
                'email',
                'created_at',
                'updated_at',
            ]);
    }

    public function testGetAllClients()
    {
        $clients = factory(Client::class, 2)->create();

        $this->get('api/clients')
            ->assertStatus(200)
            ->assertJson($clients->toArray())
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'first_name',
                    'last_name',
                    'email',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    public function testDeleteClient()
    {
        $client = factory(Client::class)->create();
        $this->delete('api/clients/'.$client->id)
            ->assertStatus(204);
    }
}
