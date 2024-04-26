<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource; //
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use \Illuminate\Database\QueryException;
use Illuminate\Support\Str;


class UserController extends Controller{

    /** @var function index Realizar uma buscar de usuários(exiber todos) */
    public function index(Request $request){
        try{

            /**  @var string $users Realizar uma pesquisa pelo nome e e-mail do usuário */
            $users = User::when($request->has('name'),function($whenQuery) use ($request){
                $whenQuery->where('name','like','%' . $request->name . '%');
            })
            ->when($request->has('email'),function($whenQuery) use ($request){
                $whenQuery->where('email','like','%' . $request->email . '%');
            })
            ->orderByDesc('created_at')->paginate(10)->withQueryString();
        
            
            /** @var class UserResource Retorna a coleção de usuários usando o método resource  */
            return UserResource::collection($users);

        }catch (QueryException $e){

            // Se ocorrer um erro de consulta ao banco de dados, registre o erro no log
            Log::error('Erro de consulta ao banco de dados: ' . $e->getMessage());

            // Retorne uma resposta de erro em JSON
            return response()->json(['error' => 'Erro ao acessar o banco de dados.'], 500);

        }catch(Exception $e){

            // Se ocorrer qualquer outro tipo de exceção, registre o erro no log
            Log::error('Erro inesperado: ' . $e->getMessage());

            // Retorne uma resposta de erro em JSON
            return response()->json(['error' => 'Ocorreu um erro inesperado.'], 500);
        }
    }



    /** @var function show Realizar uma buscar de um único usuário
     *  @var class User É a model de usuários                        
     *  @var int $user Recebe o id em forma de parâmetro, que vem da rota ( /user/{user} )
    */
    public function show(User $user){
        try{
            
            /** @var class UserResource Retorna a coleção de um único usuário usando o método resource  */
            return new UserResource($user);

        }catch (QueryException $e){

            // Se ocorrer um erro de consulta ao banco de dados, registre o erro no log
            Log::error('Erro de consulta ao banco de dados: ' . $e->getMessage());
    
            // Retorne uma resposta de erro em JSON
            return response()->json(['error' => 'Erro, usuário não encontrado.'], 404);

        } catch (Exception $e) {

            // Se ocorrer qualquer outro tipo de exceção, registre o erro no log
            Log::error('Erro inesperado: ' . $e->getMessage());
    
            // Retorne uma resposta de erro em JSON
            return response()->json(['error' => 'Ocorreu um erro inesperado.'], 500);
        }
    }



    /** @var function store Realizar um cadastro de usuário
     *  @var string $request Recebe os dados validados
    */
    public function store(UserRequest $request){
        try {

            /** @var string $validatedData Recebe a validação ativa */
            $validatedData = $request->validated();
    
            /** @var strin $user Cadastra no Banco de Dados, na tabela user
             *  @var class User É a model de usuários
            */ 
            $user = User::create([
                'nome' => $validatedData['name'],
                'email' => $validatedData['email'],
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'senha' => bcrypt($validatedData['password']), // Use bcrypt() para criptografar a senha de forma segura
            ]);
    
            // Salva no log
            Log::info('Usuário cadastrado com sucesso', ['id' => $user->id, 'conta' => $user]);
    
            // Retorne uma resposta em JSON indicando que o usuário foi cadastrado com sucesso
            return response()->json(['message' => 'Usuário cadastrado com sucesso', 'user' => $user], 201);

        } catch (Exception $e) {

            // Salva no log
            Log::warning('Usuário não cadastrado: ' . $e->getMessage());
    
            // Se ocorrer qualquer outro tipo de exceção, retorne uma resposta em JSON com uma mensagem de erro genérica
            return response()->json(['message' => 'Erro interno do servidor'], 500);
        }
    }
    
    // ===Editar os dados do banco de dados===
    public function update(UserRequest $request, User $user){
        // Validar o formulário
        $validatedData = $request->validated();

        try {
            // Editar os dados
            $user->update([
                'nome' => $validatedData['nome'],
                'valor' => str_replace(',', '.', str_replace('.', '', $validatedData['valor'])),
                'vencimento' => $validatedData['vencimento'],
            ]);

            // Salvar no log
            Log::info('Conta editada com sucesso', ['id' => $user->id, 'user' => $user]);

            // Retornar uma resposta JSON indicando sucesso
            return response()->json(['message' => 'Conta Editada com Sucesso', 'user' => $user], 200);
        } catch (\Exception $e) {
            // Salvar no log
            Log::warning('Conta não editada: ' . $e->getMessage());

            // Retornar uma resposta JSON indicando erro
            return response()->json(['message' => 'Erro no sistema, Conta não editada :('], 500);
        }
    }


}
