<?php

namespace App\Http\Controllers;

use App\Models\FichaIndividualBasica;
use App\Models\Militar;
use App\Models\ObjetivoInstrucao;
use App\Models\Subunidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class FichaInstrucaoIndividualBasicaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:admin', ['only' => ['definirObjetivosFicha', 'inserirObjetivo', 'removerObjetivo']]);
    }

    public function definirObjetivosFicha()
    {
        $user_auth = Auth::user();
        $objetivos_dentro_da_fiib = ObjetivoInstrucao::where('dentro_da_fiib', '1')->get();
        $objetivos_fora_da_fiib = ObjetivoInstrucao::where('dentro_da_fiib', '0')->get();
        return view('fichas_instrucao_individual_basicas.definir', compact('objetivos_dentro_da_fiib', 'objetivos_fora_da_fiib', 'user_auth'));
    }

    public function inserirObjetivo(Request $request, $id)
    {
        $user_auth = Auth::user();
        $objetivo_instrucao = ObjetivoInstrucao::find($id);
        $objetivo_instrucao->dentro_da_fiib = 1;
        $objetivo_instrucao->save();

        return redirect()
            ->route('fiib.definir')
            ->with('success', 'Objetivo Individual da Instrução inserido com Sucesso!');
    }

    public function removerObjetivo(Request $request, $id)
    {
        $user_auth = Auth::user();
        $objetivo_instrucao = ObjetivoInstrucao::find($id);
        $objetivo_instrucao->dentro_da_fiib = 0;
        $objetivo_instrucao->save();

        return redirect()
            ->route('fiib.definir')
            ->with('success', 'Objetivo Individual da Instrução removido com Sucesso!');
    }

    public function preencher(Request $request, $id)
    {
        $user_auth = Auth::user();
        $militar = Militar::find($id);
        $objetivos_dentro_da_fiib = ObjetivoInstrucao::where('dentro_da_fiib', '1')->orderByRaw("CAST(materia as unsigned integer) ASC")->get();
        return view('caderneta.fiib.preencher', compact('objetivos_dentro_da_fiib', 'militar', 'user_auth'));
    }

    public function realizarPreenchimento(Request $request, $id)
    {
        $user_auth = Auth::user();
        $militar = Militar::find($id);

        for ($i = 0; $i < count($request->informacoes); $i++) {
            FichaIndividualBasica::create([
                'militar_id' => $militar->id,
                'objetivo_instrucao_id' => $request->informacoes[$i][0],
                'padrao_minimo_atingido' => $request->informacoes[$i][1],
            ]);
        }
        
        return redirect()->route('caderneta.ficha', $id)
                        ->with('success','Ficha preenchida com Sucesso!');
    }

    public function pdf($militar_id){
        $militar = Militar::find($militar_id);
        
        $data = [
            'militar' => $militar
        ];
        
        $pdf = PDF::loadView('caderneta.fiib.imprimir', $data)->setPaper('a4', 'landscape');
	    return $pdf->stream('FIIB-'.$militar->numero . '-' . $militar->nome_de_guerra .'.pdf');
    }

    public function pdfSu($subunidade_id){
        $subunidade = Subunidade::find($subunidade_id);
        $militares = Militar::where('subunidade_id', $subunidade_id)->where('posto_id', 4)->get();
        
        $data = [
            'militares' => $militares
        ];
        
        $pdf = PDF::loadView('caderneta.fiib.pdf_su', $data)->setPaper('a4', 'landscape');
	    return $pdf->stream('FIIB-'.$subunidade->nome .'.pdf');
    }

}
