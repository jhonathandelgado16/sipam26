<?php

namespace App\Http\Controllers;

use App\Models\Fracao;
use App\Models\Militar;
use App\Models\MilitaresFracao;
use App\Models\Publicacao;
use App\Models\Taf;
use App\Models\TafMencao;
use App\Models\TafNumero;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TafController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:militar-edit', ['only' => ['index', 'store', 'create', 'update']]);
    }

    public function index()
    {
        $user_auth = Auth::user();
        $user = User::findOrFail($user_auth->id);

        if (Auth::user()->hasRole('Admin')) {
            $tafs_realizados = TafNumero::whereIn(
                'id',
                Taf::select('taf_numero_id')
                    ->whereYear('created_at', date('Y'))
                    ->groupBy('taf_numero_id')
                    ->get()
                    ->toArray(),
            )->get();
        } else {
            $tafs_realizados = TafNumero::whereIn(
                'id',
                Taf::select('taf_numero_id')
                    ->whereYear('tafs.created_at', date('Y'))
                    ->groupBy('taf_numero_id')
                    ->join('militars', 'tafs.militar_id', '=', 'militars.id')
                    ->where('subunidade_id', $user->subunidade_id)
                    ->get()
                    ->toArray(),
            )->get();
        }

        $mencoes = TafMencao::all();
        return view('taf.index', compact('tafs_realizados', 'mencoes', 'user'));
    }

    public function show($id)
    {
        $user_auth = Auth::user();
        $user = User::findOrFail($user_auth->id);
        if (Auth::user()->hasRole('Admin')) {
            $publicacoes_taf = Taf::getPublicacoesDeTaf(date('Y'), $id);
            $subunidade_id = null;
        } else {
            $publicacoes_taf = Taf::getPublicacoesDeTaf(date('Y'), $id, $user->subunidade_id);
            $subunidade_id = $user->subunidade_id;
        }
        $taf_numero = TafNumero::find($id);
        return view('taf.show', compact('publicacoes_taf', 'taf_numero', 'subunidade_id'));
    }

    public function create()
    {
        $user_auth = Auth::user();
        $user = User::findOrFail($user_auth->id);
        if (Auth::user()->hasRole('Admin')) {
            $militares = Militar::select('militars.id', 'numero', 'nome_de_guerra', 'posto_id', 'antiguidade')
                ->join('postos', 'militars.posto_id', '=', 'postos.id')
                ->orderBy('antiguidade', 'ASC')
                ->orderBy('numero', 'ASC')
                ->get();
        } else {
            $militares = Militar::Select('militars.id', 'numero', 'nome_de_guerra', 'posto_id', 'antiguidade')
                ->join('postos', 'militars.posto_id', '=', 'postos.id')
                ->orderBy('antiguidade', 'ASC')
                ->orderBy('numero')
                ->where('subunidade_id', $user->subunidade_id)
                ->get();
        }

        $militares = $militares->chunk(ceil($militares->count() / 3));

        $mencoes = TafMencao::all();
        $numeros = TafNumero::all();
        $publicacoes = Publicacao::all();
        return view('taf.create', compact('militares', 'mencoes', 'numeros', 'publicacoes'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'taf_numero_id' => 'required',
            'taf_mencao_id' => 'required',
            'publicacao_id' => 'required',
            'militares' => 'required',
        ]);

        $dados = [];

        for ($i = 0; $i < count($request->militares); $i++) {
            array_push($dados, [
                'militar_id' => $request->militares[$i],
                'taf_numero_id' => $request->input('taf_numero_id'),
                'taf_mencao_id' => $request->input('taf_mencao_id'),
                'publicacao_id' => $request->input('publicacao_id'),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        Taf::insert($dados);

        return redirect()
            ->route('taf.index')
            ->with('success', 'TAF inserido com sucesso!');
    }

    public function create_single($militar_id)
    {
        $militar = Militar::find($militar_id);
        $mencoes = TafMencao::all();
        $numeros = TafNumero::all();
        $publicacoes = Publicacao::all();
        return view('taf.create_single', compact('militar', 'mencoes', 'numeros', 'publicacoes'));
    }

    public function store_single(Request $request)
    {
        $this->validate($request, [
            'taf_numero_id' => 'required',
            'taf_mencao_id' => 'required',
            'publicacao_id' => 'required',
            'militar_id' => 'required',
        ]);

        $taf_realizado = Taf::create([
                'militar_id' => $request->input('militar_id'),
                'taf_numero_id' => $request->input('taf_numero_id'),
                'publicacao_id' => $request->input('publicacao_id'),
                'taf_mencao_id' => $request->input('taf_mencao_id'),
        ]);

        return redirect()->route('ficha_sipam.index', $request->input('militar_id'))->with('success', 'A Menção '. $taf_realizado->taf_mencao->mencao . ' do ' . $taf_realizado->taf_numero->numero .' foi inserida com sucesso, com essa menção o militar recebeu '. $taf_realizado->taf_mencao->pontos .' pontos!');
    }
}
