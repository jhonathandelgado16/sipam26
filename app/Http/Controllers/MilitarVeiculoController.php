<?php

namespace App\Http\Controllers;

use App\Models\Militar;
use App\Models\MilitarVeiculo;
use Illuminate\Http\Request;

class MilitarVeiculoController extends Controller
{
    //

    function __construct()
    {
        $this->middleware('permission:militar-edit', ['only' => ['index', 'store', 'create']]);
    }

    public function index($id)
    {
        $militar = Militar::find($id);
        $veiculos = MilitarVeiculo::where('militar_id', $id)->get();
        return view('ficha_acompanhamento.militar_veiculo.index', compact('militar', 'veiculos'));
    }

    public function create($id){
        $militar = Militar::find($id);
        return view('ficha_acompanhamento.militar_veiculo.create', compact('militar'));
    }

    public function store($id, Request $request){
        $militar = Militar::find($id);

        $this->validate($request, [
            'modelo' => 'required',
            'placa' => 'required',
            'ano' => 'required',
            'cor' => 'required',
            'tipo_veiculo' => 'required',
        ]);

        MilitarVeiculo::create([
            'modelo' => $request->input('modelo'),
            'placa' => $request->input('placa'),
            'ano' => $request->input('ano'),
            'cor' => $request->input('cor'),
            'tipo_veiculo' => $request->input('tipo_veiculo'),
            'documentacao' => $request->input('documentacao'),
            'pneus' => $request->input('pneus'),
            'farois' => $request->input('farois'),
            'luzes_sinalizacao' => $request->input('luzes_sinalizacao'),
            'retrovisores' => $request->input('retrovisores'),
            'triangulo_sinalizacao' => $request->input('triangulo_sinalizacao'),
            'parabrisa_limpador' => $request->input('parabrisa_limpador'),
            'capacete' => $request->input('capacete'),
            'militar_id' => $id,
        ]);

        return redirect()->route('militar_veiculos.index', $id)->with('success', 'Veículo cadastrado com sucesso!');
    }

    public function edit(MilitarVeiculo $veiculo){
        $militar = Militar::find($veiculo->militar_id);
        $veiculo = $veiculo;
        return view('ficha_acompanhamento.militar_veiculo.edit', compact('militar', 'veiculo'));
    }

    public function update(MilitarVeiculo $veiculo, Request $request){
        $this->validate($request, [
            'modelo' => 'required',
            'placa' => 'required',
            'ano' => 'required',
            'cor' => 'required',
            'tipo_veiculo' => 'required',
        ]);
            $triangulo_sinalizacao = $request->input('triangulo_sinalizacao');
            $parabrisa_limpador = $request->input('parabrisa_limpador');
            $capacete = $request->input('capacete');

            if ($request->input('tipo_veiculo') == '1') {                
                $capacete = null;
            } else {
                $triangulo_sinalizacao = null;
                $parabrisa_limpador = null;
            }

            $veiculo->modelo = $request->input('modelo');
            $veiculo->placa = $request->input('placa');
            $veiculo->ano = $request->input('ano');
            $veiculo->cor = $request->input('cor');
            $veiculo->tipo_veiculo = $request->input('tipo_veiculo');
            $veiculo->documentacao = $request->input('documentacao');
            $veiculo->pneus = $request->input('pneus');
            $veiculo->farois = $request->input('farois');
            $veiculo->luzes_sinalizacao = $request->input('luzes_sinalizacao');
            $veiculo->retrovisores = $request->input('retrovisores');
            $veiculo->triangulo_sinalizacao = $triangulo_sinalizacao;
            $veiculo->parabrisa_limpador = $parabrisa_limpador;
            $veiculo->capacete = $capacete;

            $veiculo->save();

            return redirect()->route('militar_veiculos.index', $veiculo->militar_id)->with('success', 'Veículo alterado com sucesso!');
    }
}
