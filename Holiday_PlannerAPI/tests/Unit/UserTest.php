<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use App\Http\Requests\UserRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase; 

    // protected $app; // Definir a variável $app como uma propriedade protegida

    // public function setUp(): void
    // {
    //     parent::setUp();

    //     // Inicialize a aplicação Laravel
    //     $this->app = require __DIR__.'/../../bootstrap/app.php';
    //     $this->app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    // }

    public function testStoreUser()
    {
        $user = new UserController();
        $request = new UserRequest();
        $result = $user->store($request([
            'name' => 'Olá, Mundo!',
            'email' => 'olamundo@gmail.com',
            'password' => 'senha123',
        ]));

        
        // Desabilitar o log
        Log::shouldReceive('info')->andReturnNull();

        $this->assertTrue($result);

    //     // Simular uma requisição HTTP com os dados do usuário
    //     $request = UserRequest::create('/store', 'POST', [
    //         'name' => 'Olá, Mundo!',
    //         'email' => 'olamundo@gmail.com',
    //         'password' => 'senha123',
    //         'email_verified_at' => now(),
    //         // 'remember_token' => Str::random(10),
    //     ]);

    //     // Desabilitar o log
    //     Log::shouldReceive('info')->andReturnNull();

    //     // Executar o método store do UserController com a requisição simulada
    //     $response = $this->app->make(UserController::class)->store($request);

    //     // Verificar se a resposta indica sucesso
    //     $this->assertEquals(201, $response->status());
    //     $this->assertEquals('Usuário cadastrado com sucesso', $response->getData()->message);
     }
}

