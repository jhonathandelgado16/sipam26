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
use App\Http\Controllers\CnhCategoriaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\CursoFormacaoController;
use App\Http\Controllers\EscolaridadeController;
use App\Http\Controllers\FichaAcompanhamentoController;
use App\Http\Controllers\FracaoController;
use App\Http\Controllers\PublicacaoController;
use App\Http\Controllers\TafMencaoController;
use App\Http\Controllers\TafNumeroController;
use App\Http\Controllers\SocialVisitaController;
use App\Models\CategoriaAvaliacao;
use App\Models\FichaAcompanhamento;
use App\Models\SocialVisita;

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
    Route::resource('escolaridades', EscolaridadeController::class);
    Route::resource('cursos', CursoController::class);
    Route::resource('social_visitas', SocialVisitaController::class);
    Route::resource('mencoes_taf', TafMencaoController::class);
    Route::resource('taf_numeros',TafNumeroController::class);
    Route::resource('publicacoes',PublicacaoController::class);
    Route::resource('cursos_formacao',CursoFormacaoController::class);
    Route::resource('cnh_categorias',CnhCategoriaController::class);

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
    
    Route::get('militares_fracoes/', '\App\Http\Controllers\MilitaresFracaoController@index')->name('militares_fracoes.index');
    Route::get('militares_fracoes/relacionar_militar/{id}', '\App\Http\Controllers\MilitaresFracaoController@relacionarMilitar')->name('militares_fracoes.relacionar');
    Route::post('militares_fracoes/relacionar_militar/{id}', '\App\Http\Controllers\MilitaresFracaoController@salvarRelacaoMilitar')->name('militares_fracoes.salvar');
    Route::post('militares_fracoes/remover_militar/{id}', '\App\Http\Controllers\MilitaresFracaoController@removerMilitar')->name('militares_fracoes.remover');

    Route::get('ficha_sipam/{id}', '\App\Http\Controllers\FichaSipamController@index')->name('ficha_sipam.index');
    Route::get('ficha_sipam/escolaridade/{id}', '\App\Http\Controllers\MilitarEscolaridadeController@index')->name('ficha_sipam.escolaridade_index');
    Route::get('ficha_sipam/cadastrar_escolaridade/{id}', '\App\Http\Controllers\MilitarEscolaridadeController@create')->name('ficha_sipam.escolaridade_create');
    Route::get('ficha_sipam/cadastrar_escolaridade/{id}/editar', '\App\Http\Controllers\MilitarEscolaridadeController@edit')->name('ficha_sipam.escolaridade_edit');
    Route::post('ficha_sipam/cadastrar_escolaridade/', '\App\Http\Controllers\MilitarEscolaridadeController@store')->name('ficha_sipam.escolaridade_store');
    Route::patch('ficha_sipam/cadastrar_escolaridade/update/{id}', '\App\Http\Controllers\MilitarEscolaridadeController@update')->name('ficha_sipam.escolaridade_update');
    Route::delete('ficha_sipam/cadastrar_escolaridade/delete/{id}', '\App\Http\Controllers\MilitarEscolaridadeController@destroy')->name('ficha_sipam.escolaridade_delete');

    Route::get('ficha_sipam/demerito/{id}', '\App\Http\Controllers\MilitarDemeritoController@index')->name('ficha_sipam.demerito_index');
    Route::get('ficha_sipam/cadastrar_demerito/{id}', '\App\Http\Controllers\MilitarDemeritoController@create')->name('ficha_sipam.demerito_create');
    Route::get('ficha_sipam/cadastrar_demerito/{id}/editar', '\App\Http\Controllers\MilitarDemeritoController@edit')->name('ficha_sipam.demerito_edit');
    Route::post('ficha_sipam/cadastrar_demerito/', '\App\Http\Controllers\MilitarDemeritoController@store')->name('ficha_sipam.demerito_store');
    Route::patch('ficha_sipam/cadastrar_demerito/update/{id}', '\App\Http\Controllers\MilitarDemeritoController@update')->name('ficha_sipam.demerito_update');
    Route::delete('ficha_sipam/cadastrar_demerito/delete/{id}', '\App\Http\Controllers\MilitarDemeritoController@destroy')->name('ficha_sipam.demerito_delete');

    Route::get('ficha_sipam/curso/{id}', '\App\Http\Controllers\MilitarCursoController@index')->name('ficha_sipam.curso_index');
    Route::get('ficha_sipam/cadastrar_curso/{id}', '\App\Http\Controllers\MilitarCursoController@create')->name('ficha_sipam.curso_create');
    Route::post('ficha_sipam/cadastrar_curso/', '\App\Http\Controllers\MilitarCursoController@store')->name('ficha_sipam.curso_store');

    Route::post('cursos/aprovar/', '\App\Http\Controllers\MilitarCursoController@aprovarCurso')->name('cursos.aprovar');
    Route::post('cursos/reprovar/', '\App\Http\Controllers\MilitarCursoController@reprovarCurso')->name('cursos.reprovar');

    Route::get('ficha_sipam/create/{id}/{curso_id}', '\App\Http\Controllers\MilitarCursoController@createComCurso')->name('cursos.create_com_curso');

    Route::get('ficha_sipam/curso/encontrar/{id}', '\App\Http\Controllers\MilitarCursoController@encontrar')->name('cursos.encontrar');
    Route::post('ficha_sipam/curso/encontrar/{id}', '\App\Http\Controllers\MilitarCursoController@encontrarCurso')->name('cursos.encontrar_curso');

    Route::get('ficha_acompanhamento/{id}', '\App\Http\Controllers\FichaAcompanhamentoController@index')->name('ficha_acompanhamentos.index');
    Route::get('ficha_acompanhamento/create/{id}', '\App\Http\Controllers\FichaAcompanhamentoController@create')->name('ficha_acompanhamentos.create');
    Route::post('ficha_acompanhamento/create/{id}', '\App\Http\Controllers\FichaAcompanhamentoController@store')->name('ficha_acompanhamentos.store');
    Route::get('ficha_acompanhamento/edit/{id}', '\App\Http\Controllers\FichaAcompanhamentoController@edit')->name('ficha_acompanhamentos.edit');
    Route::patch('ficha_acompanhamento/edit/{id}', '\App\Http\Controllers\FichaAcompanhamentoController@update')->name('ficha_acompanhamentos.update');

    Route::get('ficha_acompanhamento/pdf/{ficha_acompanhamento}', '\App\Http\Controllers\FichaAcompanhamentoController@pdf')->name('ficha_acompanhamentos.pdf');

    Route::get('visita_social/{id}', '\App\Http\Controllers\SocialVisitaController@index')->name('visita_sociais.index');
    Route::get('visita_social/create/{id}', '\App\Http\Controllers\SocialVisitaController@create')->name('visita_sociais.create');
    Route::post('visita_social/{id}', '\App\Http\Controllers\SocialVisitaController@store')->name('visita_sociais.store');

    Route::get('militar_veiculo/{id}', '\App\Http\Controllers\MilitarVeiculoController@index')->name('militar_veiculos.index');
    Route::get('militar_veiculo/create/{id}', '\App\Http\Controllers\MilitarVeiculoController@create')->name('militar_veiculos.create');
    Route::post('militar_veiculo/{id}', '\App\Http\Controllers\MilitarVeiculoController@store')->name('militar_veiculos.store');
    Route::patch('militar_veiculo/edit/{veiculo}', '\App\Http\Controllers\MilitarVeiculoController@update')->name('militar_veiculos.update');
    Route::get('militar_veiculo/edit/{veiculo}', '\App\Http\Controllers\MilitarVeiculoController@edit')->name('militar_veiculos.edit');

    Route::get('taf/create', '\App\Http\Controllers\TafController@create')->name('taf.create');
    Route::post('taf', '\App\Http\Controllers\TafController@store')->name('taf.store');
    Route::get('taf/create_single/{militar_id}', '\App\Http\Controllers\TafController@create_single')->name('taf.create_single');
    Route::post('taf/store_single', '\App\Http\Controllers\TafController@store_single')->name('taf.store_single');
    Route::get('taf', '\App\Http\Controllers\TafController@index')->name('taf.index');
    Route::get('taf/show/{id}', '\App\Http\Controllers\TafController@show')->name('taf.show');

    Route::get('curso_formacao_militar/create/{militar_id}', '\App\Http\Controllers\CursoFormacaoMilitarController@create')->name('curso_formacao_militar.create');
    Route::post('curso_formacao_militar', '\App\Http\Controllers\CursoFormacaoMilitarController@store')->name('curso_formacao_militar.store');

    Route::get('cnh_militar/create/{militar_id}', '\App\Http\Controllers\CnhMilitarController@create')->name('cnh_militar.create');
    Route::post('cnh_militar', '\App\Http\Controllers\CnhMilitarController@store')->name('cnh_militar.store');

    Route::get('relatorios/faltas', '\App\Http\Controllers\RelatoriosController@index')->name('relatorios.faltas');
    Route::get('relatorios/pdf', '\App\Http\Controllers\RelatoriosController@pdf')->name('relatorios.pdf');

    Route::get('categorias_avaliacoes/definir/{categoria_atributo_id}', '\App\Http\Controllers\CategoriaAvaliacaoController@definir')->name('categorias_avaliacoes.definir');
    Route::post('categorias_avaliacoes/definir', '\App\Http\Controllers\CategoriaAvaliacaoController@definir_store')->name('categorias_avaliacoes.definir_store');

    Route::get('avaliacao/realizar/{militar_id}', '\App\Http\Controllers\AvaliacaoController@realizar')->name('avaliacao.realizar');
    Route::post('avaliacao/realizar', '\App\Http\Controllers\AvaliacaoController@store')->name('avaliacao.store');
    Route::get('avaliacao', '\App\Http\Controllers\AvaliacaoController@index')->name('avaliacao.index');
    Route::get('avaliacao/edit/{militar_id}', '\App\Http\Controllers\AvaliacaoController@edit')->name('avaliacao.edit');
    Route::patch('avaliacao/edit', '\App\Http\Controllers\AvaliacaoController@update')->name('avaliacao.update');
    Route::get('avaliacao/aprovar/{militar_id}', '\App\Http\Controllers\AvaliacaoController@aprovar')->name('avaliacao.aprovar');
    Route::patch('avaliacao/aprovar', '\App\Http\Controllers\AvaliacaoController@aprovar_update')->name('avaliacao.aprovar_update');

    Route::get('ranking/', '\App\Http\Controllers\RankingController@index')->name('ranking.index');
    Route::get('ranking/atualizar', '\App\Http\Controllers\RankingController@atualizar')->name('ranking.atualizar');

    Route::get('desmobilizacao/curriculo/{militar_id}', '\App\Http\Controllers\DesmobilizacaoController@curriculo')->name('desmobilizacao.curriculo');
});

