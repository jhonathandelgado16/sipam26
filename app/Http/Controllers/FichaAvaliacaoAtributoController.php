<?php

namespace App\Http\Controllers;

use App\Models\FichaAvaliacaoAtributo;
use App\Models\FichaIndividualBasica;
use App\Models\Militar;
use App\Models\ObjetivoInstrucao;
use App\Models\Subunidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class FichaAvaliacaoAtributoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:admin', ['only' => ['']]);
    }

    public function preencher(Request $request, $id)
    {
        $user_auth = Auth::user();
        $militar = Militar::find($id);
        $atributos = [['cooperacao', 'COOPERAÇÃO'], ['autoconfianca', 'AUTOCONFIANÇA'], ['persistencia', 'PERSISTÊNCIA'], ['iniciativa', 'INICIATIVA'], ['coragem', 'CORAGEM'], ['responsabilidade', 'RESPONSABILIDADE'], ['disciplina', 'DISCIPLINA'], ['equilibrio_emocional', 'EQUILÍBRIO EMOCIONAL'], ['entusiasmo_profissional', 'ENTUSIASMO PROFISSIONAL']];
        return view('caderneta.faat.preencher', compact('militar', 'user_auth', 'atributos'));
    }

    public function realizarPreenchimento(Request $request, $id)
    {
        $user_auth = Auth::user();
        $militar = Militar::find($id);

        FichaAvaliacaoAtributo::create([
            'militar_id' => $militar->id,
            'cooperacao' => $request->cooperacao,
            'autoconfianca' => $request->autoconfianca,
            'persistencia' => $request->persistencia,
            'iniciativa' => $request->iniciativa,
            'coragem' => $request->coragem,
            'responsabilidade' => $request->responsabilidade,
            'disciplina' => $request->disciplina,
            'equilibrio_emocional' => $request->equilibrio_emocional,
            'entusiasmo_profissional' => $request->entusiasmo_profissional,
            'matricula_cfc' => $request->matricula_cfc,
            'punicao_fase' => $request->punicao_fase,
            'avaliacao_global' => $request->avaliacao_global,
        ]);

        return redirect()
            ->route('caderneta.ficha', $id)
            ->with('success', 'FAAT preenchida com Sucesso!');
    }

    public function pdf($militar_id){
        $militar = Militar::find($militar_id);
        
        $data = [
            'militar' => $militar
        ];
        
        $pdf = PDF::loadView('caderneta.faat.imprimir', $data)->setPaper('a4');
	    return $pdf->stream('FAAT-'.$militar->numero . '-' . $militar->nome_de_guerra .'.pdf');
    }
}
