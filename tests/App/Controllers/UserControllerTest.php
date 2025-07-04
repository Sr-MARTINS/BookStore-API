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
        //Simula os dados passados 
        $data = [
            'name' => 'Martins',
            'email' => 'martins@gmail.com',
            'password' => '123456'
        ];

        //estanciaremso o 'postJson' para simula requisição POST
        //passaresmos como argumento do metodo a rout e os valores q semula os dados  
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

    #php artisan test --filter=UserControllerTest::test_show_user
    public function test_show_user()
    {
        $user = User::factory()->create([
            'name' => 'Martins',
            'email' => 'martins@gmail.com'
        ]);

        $response = $this->getJson("/api/user/{$user->id}");

        $response->assertStatus(200)->assertJsonFragment([
            'message' => 'Usuario:',
            'name' => 'Martins',
            'email' => 'martins@gmail.com'
        ]);
    }

    #php artisan test --filter=UserControllerTest::test_update_user
    public function test_update_user()
    {
        $user = User::factory()->create([
            'name' => 'Martins',
            'email' => 'martins@gmail.com'
        ]);

        $userAtualizado = [
            'name' => 'MartinsAtualiado',
            'email' => 'martinsatualizado@gmial.com',
            'password' => '12345678'
        ];

        $response = $this->putJson("/api/user/{$user->id}", $userAtualizado);

        $response->assertStatus(200)->assertJsonFragment([
            'message' => 'Usuario editado com sucesso',
            'name'    => 'MartinsAtualiado',
            'email'   => 'martinsatualizado@gmial.com'
        ]);
    }

    #php artisan test --filter=UserControllerTest::test_delete_user
    public function test_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/user/{$user->id}");

        $response->assertStatus(200)->assertJsonFragment([
            'message' => 'Usuario deletado com sucesso',
        ]);
    }


        //Create: dados inválidos
    public function test_create_user_invalid_data()
    {
        $data = [
            'name' => '',
            'email' => 'email-invalido',
            'password' => '123'
        ];

        $response = $this->postJson('/api/user', $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }

        //Show: usuário não encontrado
    public function test_show_user_not_found()
    {
        $response = $this->getJson("/api/user/9999");

        $response->assertStatus(404)->assertJsonFragment([
            'message' => 'Usuario nao encontrado'
        ]);
    }

    //Update: usuário não encontrado
    public function test_update_user_not_found()
    {
        $updateData = [
            'name' => 'Fulano',
            'email' => 'fulano@email.com',
            'password' => '12345678'
        ];

        $response = $this->putJson('/api/user/9999', $updateData);

        $response->assertStatus(404)->assertJsonFragment([
            'message' => 'Usuario nao encontrado'
        ]);
    }
}