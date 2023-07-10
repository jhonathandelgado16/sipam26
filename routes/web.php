<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AtributoController;
use App\Http\Controllers\CadernetaController;
use App\Http\Controllers\CategoriaAvaliacaoController;
use App\Http\Controllers\FichaInstrucaoIndividualBasicaController;
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
use App\Http\Controllers\CategoriaAtributoController;
use App\Http\Controllers\FracaoController;
use App\Models\CategoriaAvaliacao;

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
    Route::resource('fiib', FichaInstrucaoIndividualBasicaController::class);
    Route::resource('categorias_avaliacoes', CategoriaAvaliacaoController::class);
    Route::resource('categorias_atributos', CategoriaAtributoController::class);
    Route::resource('atributos', AtributoController::class);
    Route::resource('fracoes', FracaoController::class);

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::get('procurar/militares', '\App\Http\Controllers\MilitarController@procurar')->name('militares.procurar');
    Route::get('procurar/militares/su', '\App\Http\Controllers\MilitarController@procurarPorSu')->name('militares.procurar_subunidade');

    Route::get('caderneta/fo/inserir/{id_militar}', '\App\Http\Controllers\FatoObservadoController@inserirFato')->name('fo.inserir');
    Route::post('caderneta/fo/cadastrar', '\App\Http\Controllers\FatoObservadoController@salvar')->name('fo.store');

    Route::get('caderneta/observacao/inserir/{id_militar}', '\App\Http\Controllers\ObservacaoController@inserirObservacao')->name('obs.inserir');
    Route::post('caderneta/onservacao/cadastrar', '\App\Http\Controllers\ObservacaoController@salvar')->name('obs.store');

    Route::get('caderneta/visita_medica/inserir/{id_militar}', '\App\Http\Controllers\VisitaMedicaController@inserirVisitaMedica')->name('visita_medica.inserir');
    Route::post('caderneta/visita_medica/cadastrar', '\App\Http\Controllers\VisitaMedicaController@salvar')->name('visita_medica.store');

    Route::get('caderneta/vacina_aplicada/inserir/{id_militar}', '\App\Http\Controllers\VacinaAplicadaController@inserirVacinaAplicada')->name('vacina_aplicada.inserir');
    Route::post('caderneta/vacina_aplicada/cadastrar', '\App\Http\Controllers\VacinaAplicadaController@salvar')->name('vacina_aplicada.store');

    Route::get('caderneta/ficha/{militar_id}', '\App\Http\Controllers\CadernetaController@ficha')->name('caderneta.ficha');

    Route::get('fiib/definir/oii', '\App\Http\Controllers\FichaInstrucaoIndividualBasicaController@definirObjetivosFicha')->name('fiib.definir');
    Route::post('fiib/inserir/{id}', '\App\Http\Controllers\FichaInstrucaoIndividualBasicaController@inserirObjetivo')->name('fiib.inserir_oii');
    Route::post('fiib/remover/{id}', '\App\Http\Controllers\FichaInstrucaoIndividualBasicaController@removerObjetivo')->name('fiib.remover_oii');
    Route::get('fiib/preencher/{id}', '\App\Http\Controllers\FichaInstrucaoIndividualBasicaController@preencher')->name('fiib.preencher');
    Route::post('fiib/preencher/{id}', '\App\Http\Controllers\FichaInstrucaoIndividualBasicaController@realizarPreenchimento')->name('fiib.realizar');
    Route::get('fiib/pdf/{id}', '\App\Http\Controllers\FichaInstrucaoIndividualBasicaController@pdf')->name('fiib.pdf');
    Route::get('fiib/pdf_su/{subunidade_id}', '\App\Http\Controllers\FichaInstrucaoIndividualBasicaController@pdfSu')->name('fiib.pdf_su');

    Route::get('faat/preencher/{id}', '\App\Http\Controllers\FichaAvaliacaoAtributoController@preencher')->name('faat.preencher');
    Route::post('faat/preencher/{id}', '\App\Http\Controllers\FichaAvaliacaoAtributoController@realizarPreenchimento')->name('faat.realizar');
    Route::get('faat/pdf/{id}', '\App\Http\Controllers\FichaAvaliacaoAtributoController@pdf')->name('faat.pdf');

});

