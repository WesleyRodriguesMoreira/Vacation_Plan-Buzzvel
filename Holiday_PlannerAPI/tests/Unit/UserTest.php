<?php
namespace Tests\Unit;
use App\Http\Controllers\UserController;
use App\Http\Requests\UserRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase{

    use RefreshDatabase;

    /** @var function testStoreUser Criar um teste de cadastro de usuário  */
    public function testStoreUser(){

        /** @var strin $user Receber os dados da model user */
        $user = new UserController();
        $request = new UserRequest([
            'name' => 'Olá, Mundo!',
            'email' => 'olamundo@gmail.com',
            'password' => 'senha123',
        ]);

        $request->merge([
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Desabilitar o log
        Log::shouldReceive('info')->andReturnNull();

        $response = $user->store($request);

        // Retorna uma mensagem de sucesso
        $this->assertEquals(201, $response->status());
        $this->assertEquals('Usuário cadastrado com sucesso', $response->getData()->message);
    }


    
}
