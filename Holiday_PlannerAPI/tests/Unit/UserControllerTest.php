<?php

namespace Tests\Feature;

use App\Http\Controllers\UserController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    private $user;

    public function setUp(): void{
        parent::setUp();
        $this->user = new UserController;
    }

    public function testStoreNewUser(){

        // Crie uma instância de Request com os dados necessários
        $request = new Request([
            'name' => 'Olá Mundo Doe',  
            'email' => 'john@example.com',
            'password' => 'password123',
        ]);

        // Chame a função store do controlador UserController
        $response = $this->postJson('/store', $request->all());

        // Verifique se a resposta JSON está correta
        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Usuário cadastrado com sucesso',
                // Aqui você pode adicionar outras chaves que espera encontrar na resposta JSON
            ]);
    }
}
