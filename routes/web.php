<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CadernetaController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MilitarController;
use App\Http\Controllers\PelotaoController;
use App\Http\Controllers\PostoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\ObjetivoInstrucaoController;
use App\Http\Controllers\OIIController;
use App\Http\Controllers\SubunidadeController;
use App\Http\Controllers\VacinaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('subunidades', SubunidadeController::class);
    Route::resource('postos', PostoController::class);
    Route::resource('pelotoes', PelotaoController::class);
    Route::resource('militares', MilitarController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('caderneta', CadernetaController::class);
    Route::resource('medicos', MedicoController::class);
    Route::resource('vacinas', VacinaController::class);
    Route::resource('objetivos_instrucoes', ObjetivoInstrucaoController::class);


    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::get('procurar/militares', '\App\Http\Controllers\MilitarController@procurar')->name('militares.procurar');

    Route::get('caderneta/fo/inserir/{id_militar}', '\App\Http\Controllers\FatoObservadoController@inserirFato')->name('fo.inserir');
    Route::post('caderneta/fo/cadastrar', '\App\Http\Controllers\FatoObservadoController@salvar')->name('fo.store');

    Route::get('caderneta/observacao/inserir/{id_militar}', '\App\Http\Controllers\ObservacaoController@inserirObservacao')->name('obs.inserir');
    Route::post('caderneta/onservacao/cadastrar', '\App\Http\Controllers\ObservacaoController@salvar')->name('obs.store');

    Route::get('caderneta/visita_medica/inserir/{id_militar}', '\App\Http\Controllers\VisitaMedicaController@inserirVisitaMedica')->name('visita_medica.inserir');
    Route::post('caderneta/visita_medica/cadastrar', '\App\Http\Controllers\VisitaMedicaController@salvar')->name('visita_medica.store');

    Route::get('caderneta/vacina_aplicada/inserir/{id_militar}', '\App\Http\Controllers\VacinaAplicadaController@inserirVacinaAplicada')->name('vacina_aplicada.inserir');
    Route::post('caderneta/vacina_aplicada/cadastrar', '\App\Http\Controllers\VacinaAplicadaController@salvar')->name('vacina_aplicada.store');

    Route::get('caderneta/ficha/{militar_id}', '\App\Http\Controllers\CadernetaController@ficha')->name('caderneta.ficha');

});

