<?php

namespace App\Http\Controllers;

use App\Models\FichaAcompanhamento;
use App\Models\Militar;
use App\Models\MilitarVeiculo;
use App\Models\Observacao;
use App\Models\SocialVisita;
use PDF;
use Illuminate\Http\Request;

class FichaAcompanhamentoController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:militar-edit|militar-caderneta', ['only' => ['index', 'store', 'create', 'edit', 'pdf']]);
    }

    public function index($id)
    {
        $militar = Militar::find($id);
        $ficha = FichaAcompanhamento::where('militar_id', $id)->first();
        $visita_sociais = SocialVisita::where('militar_id', $id)->limit(3)->get();
        $veiculos = MilitarVeiculo::where('militar_id', $id)->limit(1)->get();
        $observacoes = Observacao::where('militar_id', $id)->orderBy('data', 'ASC')->get();
        return view('ficha_acompanhamento.index', compact('militar', 'ficha', 'visita_sociais', 'veiculos', 'observacoes'));
    }

    public function create($id)
    {
        $militar = Militar::find($id);
        return view('ficha_acompanhamento.create', compact('militar'));
    }

    public function store($id, Request $request)
    {

        $this->validate($request, [
            'acidentes_atividades_militares' => 'required',
            'acidentes_automobilisticos' => 'required',
            'possui_cnh' => 'required',
        ]);

        $acidentes_motociclisticos = $request->input('acidentes_motociclisticos');
        if ($request->input('possui_cnh') == '2') {
            $acidentes_motociclisticos = null;
        }

        $conducao_cnh = $request->input('conducao_motocicleta');
        $acidentes_motociclisticos_bi = 'BI nº ' . $request->input('acidentes_motociclisticos_numero_bi') . ' do dia ' . date("d/m/Y", strtotime($request->input('acidentes_motociclisticos_data_bi')));

        if ($request->input('acidentes_motociclisticos') == '2' || $request->input('possui_cnh') == '2') {
            $conducao_cnh = null;
            $acidentes_motociclisticos_bi = null;
        }

        $acidentes_atividades_militares_bi = 'BI nº ' . $request->input('acidentes_atividades_militares_numero_bi') . ' do dia ' . date("d/m/Y", strtotime($request->input('acidentes_atividades_militares_data_bi')));

        if ($request->input('acidentes_atividades_militares') == '2') {
            $acidentes_atividades_militares_bi = '';
        }

        $acidentes_automobilisticos_bi = 'BI nº ' . $request->input('acidentes_automobilisticos_numero_bi') . ' do dia ' . date("d/m/Y", strtotime($request->input('acidentes_automobilisticos_data_bi')));

        if ($request->input('acidentes_automobilisticos') == '2') {
            $acidentes_automobilisticos_bi = '';
        }

        $ficha_acompanhamento = FichaAcompanhamento::create(
            [
                'nome_esposa' => $request->input('nome_esposa'),
                'contato_esposa' => $request->input('contato_esposa'),
                'nome_pai' => $request->input('nome_pai'),
                'contato_pai' => $request->input('contato_pai'),
                'nome_mae' => $request->input('nome_mae'),
                'contato_mae' => $request->input('contato_mae'),
                'qtd_irmaos' => $request->input('qtd_irmaos'),
                'renda_familiar' => $request->input('renda_familiar'),
                'objetivo_de_vida' => $request->input('objetivo_de_vida'),
                'lazer' => $request->input('lazer'),
                'acidentes_atividades_militares' => $request->input('acidentes_atividades_militares'),
                'acidentes_atividades_militares_bi' => $acidentes_atividades_militares_bi,
                'acidentes_automobilisticos' => $request->input('acidentes_automobilisticos'),
                'acidentes_automobilisticos_bi' => $acidentes_automobilisticos_bi,
                'acidentes_motociclisticos' => $acidentes_motociclisticos,
                'acidentes_motociclisticos_bi' => $acidentes_motociclisticos_bi,
                'possui_cnh' => $request->input('possui_cnh'),
                'conducao_motocicleta' => $conducao_cnh,
                'militar_id' => $id,
            ]
        );

        return redirect()->route('ficha_acompanhamentos.index', $id)->with('success', 'Ficha de acompanhamento preechida com sucesso!');
    }

    public function edit($id)
    {
        $militar = Militar::find($id);
        $ficha = FichaAcompanhamento::where('militar_id', $id)->first();

        return view('ficha_acompanhamento.edit', compact('militar', 'ficha'));
    }

    public function update($id, Request $request)
    {

        $this->validate($request, [
            'acidentes_atividades_militares' => 'required',
            'acidentes_automobilisticos' => 'required',
            'possui_cnh' => 'required',
        ]);

        $acidentes_motociclisticos = $request->input('acidentes_motociclisticos');
        if ($request->input('possui_cnh') == '2') {
            $acidentes_motociclisticos = null;
        }

        $conducao_cnh = $request->input('conducao_motocicleta');
        $acidentes_motociclisticos_bi = 'BI nº ' . $request->input('acidentes_motociclisticos_numero_bi') . ' do dia ' . date("d/m/Y", strtotime($request->input('acidentes_motociclisticos_data_bi')));

        if ($request->input('acidentes_motociclisticos') == '2' || $request->input('possui_cnh') == '2') {
            $conducao_cnh = null;
            $acidentes_motociclisticos_bi = null;
        }

        $acidentes_atividades_militares_bi = 'BI nº ' . $request->input('acidentes_atividades_militares_numero_bi') . ' do dia ' . date("d/m/Y", strtotime($request->input('acidentes_atividades_militares_data_bi')));

        if ($request->input('acidentes_atividades_militares') == '2') {
            $acidentes_atividades_militares_bi = '';
        }

        $acidentes_automobilisticos_bi = 'BI nº ' . $request->input('acidentes_automobilisticos_numero_bi') . ' do dia ' . date("d/m/Y", strtotime($request->input('acidentes_automobilisticos_data_bi')));

        if ($request->input('acidentes_automobilisticos') == '2') {
            $acidentes_automobilisticos_bi = '';
        }

        $ficha_acompanhamento = FichaAcompanhamento::find($request->input('ficha_id'));
        $ficha_acompanhamento->nome_esposa = $request->input('nome_esposa');
        $ficha_acompanhamento->contato_esposa = $request->input('contato_esposa');
        $ficha_acompanhamento->nome_pai = $request->input('nome_pai');
        $ficha_acompanhamento->contato_pai = $request->input('contato_pai');
        $ficha_acompanhamento->nome_mae = $request->input('nome_mae');
        $ficha_acompanhamento->contato_mae = $request->input('contato_mae');
        $ficha_acompanhamento->qtd_irmaos = $request->input('qtd_irmaos');
        $ficha_acompanhamento->renda_familiar = $request->input('renda_familiar');
        $ficha_acompanhamento->objetivo_de_vida = $request->input('objetivo_de_vida');
        $ficha_acompanhamento->lazer = $request->input('lazer');
        $ficha_acompanhamento->acidentes_atividades_militares = $request->input('acidentes_atividades_militares');
        $ficha_acompanhamento->acidentes_atividades_militares_bi = $acidentes_atividades_militares_bi;
        $ficha_acompanhamento->acidentes_automobilisticos = $request->input('acidentes_automobilisticos');
        $ficha_acompanhamento->acidentes_automobilisticos_bi = $acidentes_automobilisticos_bi;
        $ficha_acompanhamento->acidentes_motociclisticos = $acidentes_motociclisticos;
        $ficha_acompanhamento->acidentes_motociclisticos_bi = $acidentes_motociclisticos_bi;
        $ficha_acompanhamento->possui_cnh = $request->input('possui_cnh');
        $ficha_acompanhamento->conducao_motocicleta = $conducao_cnh;

        $ficha_acompanhamento->save();

        return redirect()->route('ficha_acompanhamentos.index', $id)->with('success', 'Ficha de acompanhamento atualizada com sucesso!');
    }

    public function pdf(FichaAcompanhamento $ficha_acompanhamento)
    {   
        $militar = Militar::find($ficha_acompanhamento->militar_id);
        $visitas_sociais = SocialVisita::where('militar_id', $militar->id)->orderBy('data', 'desc')->limit(1)->get();
        $carros = MilitarVeiculo::where('militar_id', $militar->id)->where('tipo_veiculo', 1)->get();
        $motos = MilitarVeiculo::where('militar_id', $militar->id)->where('tipo_veiculo', 2)->get();
        $pdf = PDF::loadView('ficha_acompanhamento.ficha_pdf', compact('ficha_acompanhamento', 'militar', 'visitas_sociais', 'carros', 'motos'))->setPaper('a4', 'landscape');
        return $pdf->stream('ficha acompanhamento '. $militar->getMilitar() .'.pdf');
    }
}
