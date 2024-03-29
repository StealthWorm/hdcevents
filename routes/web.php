<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {

//     $nome = "Matheus";
//     $idade = 29;

//     $arr = [10, 20, 30, 40, 50];

//     $nomes = ["Matheus", "Maria", "João", "Saulo"];

//     return view(
//         'welcome',
//         [
//             'nome' => $nome,
//             'idade2' => $idade,
//             'profissao' => "Programador",
//             'arr' => $arr,
//             'nomes' => $nomes
//         ]
//     );
// });

// o "index" é a function declarada dentro do Controller
Route::get('/', [EventController::class, 'index']);
Route::get('/events/create', [EventController::class, 'create']);
Route::get('/events/{id}', [EventController::class, 'show']);
Route::post('/events', [EventController::class, 'store']);

Route::get('/contact', function () {
    return view('contact');
});

// Route::get('/produtos', function () {
//     $busca = request('search');  //Pega o valor da busca da request como query param
//     return view('products', ['busca' => $busca]);
// });

// Route::get('/produto/{id}', function ($id) {
//     return view('product', ['id' => $id]);
// });

// {id?} indica que o param é opcional, logo, precisamos setar um valor default
// Route::get('/produtos_teste/{id?}', function ($id = null) {
//     return view('product', ['id' => $id]);
// });

// php artisan migrate para rodar migrations e gerar tabelas
// php artisan make:controller <nome do controller> para gerar controller
// php artisan serve para startar o sistema

// php artisan make:migration create_products_table -> cria o template de uma migration para edição antes do commit
// php artisan migrate status -> permite ver como estão as migrations do banco
// php artisan migrate:rollback -> para desfazer a transação da migration
// php artisan migrate:reset -> para desfazer todas as transaçoes de migrations
// php artisan migrate:refresh -> faz o rollback da migration e entao executa o migrate novamente
// php artisan migrate:fresh -> faz o rollback de todas as migrations e executa o migrate novamente para todas
// php artisan make:migration add_image_to_events_table -> adiciona o campo de forma incremental, sem resetar os dados

// ELOQUENT (ORM do Laravel)

// no laravel é comum ter uma action especifica para POST chamda "store"
