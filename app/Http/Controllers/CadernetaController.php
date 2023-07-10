<?php

namespace App\Http\Controllers;

use App\Models\VisitaMedica;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FatoObservado;
use App\Models\FichaIndividualBasica;
use App\Models\Militar;
use App\Models\Observacao;
use App\Models\User;
use App\Models\VacinaAplicada;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Auth;

class CadernetaController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:admin', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        $fatos = FatoObservado::orderBy('data_lancamento', 'ASC')->get();
        $observacoes = Observacao::orderBy('data', 'ASC')->get();
        return view('caderneta.index', compact('fatos', 'data'));
    }

    public function ficha($militar_id)
    {
        $militar = Militar::find($militar_id);
        $fatos = FatoObservado::where('militar_id', $militar_id)->orderBy('data_lancamento', 'ASC')->get();
        $observacoes = Observacao::where('militar_id', $militar_id)->orderBy('data', 'ASC')->get();
        $visitas_medicas = VisitaMedica::where('militar_id', $militar_id)->orderBy('data_visita', 'ASC')->get();
        $vacinas_aplicadas = VacinaAplicada::where('militar_id', $militar_id)->orderBy('data_aplicacao', 'ASC')->get();
        $resultados_fiib = FichaIndividualBasica::select('objetivo_instrucao_id', 'padrao_minimo_atingido')->join('objetivo_instrucaos', 'objetivo_instrucaos.id', '=', 'ficha_individual_basicas.objetivo_instrucao_id')->where('militar_id', $militar_id)->orderByRaw('CONVERT(materia, SIGNED) asc')->orderBy('identificacao','asc')->get();
        $faat = $militar->getInformacoesFaat();

        return view('caderneta.index', compact('fatos', 'observacoes', 'militar','visitas_medicas', 'vacinas_aplicadas', 'resultados_fiib', 'faat'));
    }
}
