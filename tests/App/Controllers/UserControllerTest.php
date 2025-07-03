<?php

namespace Tests\App\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

# php artisan test --filter=UserControllerTest
class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    # php artisan test --filter=UserControllerTest::test_index_lista_de_usuers
    public function test_index_lista_de_usuers()
    {
        User::factory()->count(3)->create();

        $response = $this->getJson('/api/user');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    '*' => ['id', 'name', 'email', 'created_at', 'updated_at']
                ]
        ]);
    }

    # php artisan test --filter=UserControllerTest::test_create_user
    public function test_create_user()
    {
        $data = [
            'name' => 'Martins',
            'email' => 'martins@gmail.com',
            'password' => '123456'
        ];

        $response = $this->postJson('/api/user', $data);

        $response->assertStatus(200)
         ->assertJsonFragment([
             'message' => 'Usuario creado com sucesso',
             'name' => 'Martins'
         ])
         ->assertJsonStructure([
             'message',
             'data' => [
                 'id',
                 'name',
                 'email',
                 'created_at',
                 'updated_at'
             ]
         ]);

         $this->assertDatabaseHas('users', ['email' => 'martins@gmail.com']);
    }
}