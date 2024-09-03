<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fracao;
use App\Models\Militar;
use App\Models\MilitaresFracao;
use App\Models\Pelotao;
use App\Models\Posto;
use App\Models\QualificacaoMilitar;
use App\Models\Subunidade;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Auth;

class MilitarController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:militar-list|militar-create|militar-edit|militar-delete', ['only' => ['index','store', 'procurar']]);
         $this->middleware('permission:militar-create', ['only' => ['create','store']]);
         $this->middleware('permission:militar-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:militar-delete', ['only' => ['destroy']]);
         $this->middleware('permission:militar-list', ['only' => ['procurar']]);
    }

    public function index(Request $request)
    {
        $search = '';
        $search_su = '';
        $subunidades = Subunidade::all();
        $user_auth = Auth::user();
        $user = User::findOrFail($user_auth->id);
        if (Auth::user()->hasRole('Admin')) {
            $militares = Militar::select('militars.id', 'numero', 'nome_de_guerra', 'posto_id', 'antiguidade')->join('postos', 'militars.posto_id', '=', 'postos.id')->
            orderBy('antiguidade', 'ASC')->orderBy('numero', 'ASC')->limit(100);   
        } elseif(Auth::user()->hasRole('Cmt Fração')) {
            $militares = Militar::Select('militars.id', 'numero', 'nome_de_guerra', 'posto_id', 'antiguidade')->join('postos', 'militars.posto_id', '=', 'postos.id')->
            orderBy('antiguidade', 'ASC')->orderBy('numero')->whereIn('militars.id', MilitaresFracao::select('militar_id')->whereIn('fracao_id', (Fracao::select('id')->where('user_id', $user->id)->get()->toArray()))->get()->toArray());
        } else {
            $militares = Militar::Select('militars.id', 'numero', 'nome_de_guerra', 'posto_id', 'antiguidade')->join('postos', 'militars.posto_id', '=', 'postos.id')->
            orderBy('antiguidade', 'ASC')->orderBy('numero')->where('subunidade_id', $user->subunidade_id);
        }

        $militares = $militares->where('situacao', 'ativa')->get();

        return view('militares.index',compact('user_auth', 'militares', 'subunidades', 'search', 'search_su'));
    }

    public function procurar(Request $request)
    {
        $search = $request->input('search');
        $user_auth = Auth::user();
        $search_su = '';

        $subunidades = Subunidade::all();

        $user = User::findOrFail($user_auth->id);
        if (Auth::user()->hasRole('Admin')) {
            $militares = Militar::where('nome_de_guerra', 'LIKE', "%{$search}%")
            ->orWhere('numero', 'LIKE', "%{$search}%")->orderBy('numero');
        } elseif(Auth::user()->hasRole('Cmt Fração')) {
            $militares = Militar::Select('militars.id', 'numero', 'nome_de_guerra', 'posto_id', 'antiguidade')->join('postos', 'militars.posto_id', '=', 'postos.id')->
            orderBy('antiguidade', 'ASC')->orderBy('numero')->whereIn('militars.id', MilitaresFracao::select('militar_id')->whereIn('fracao_id', (Fracao::select('id')->where('user_id', $user->id)->get()->toArray()))->get()->toArray())->where('nome_de_guerra', 'LIKE', "%{$search}%");
        }
        else {
            $militares = Militar::where('subunidade_id', $user->subunidade_id)->orWhere('nome_de_guerra', 'LIKE', "%{$search}%")
            ->orWhere('numero', 'LIKE', "%{$search}%")->orderBy('numero');

            $militares = Militar::whereRaw('(nome_de_guerra LIKE "%'.$search.'%" OR numero LIKE "%'.$search.'%") and subunidade_id = '.$user->subunidade_id.'')->orderBy('numero', 'ASC');
        }

        $militares = $militares->where('situacao', 'ativa')->get();

        return view('militares.index',compact('user_auth', 'militares', 'subunidades', 'search', 'search_su'));
    }

    public function procurarPorSu(Request $request)
    {
        $su = $request->input('subunidade_id');
        $user_auth = Auth::user();
        $search = "";
        $search_su = $su;
        $subunidades = Subunidade::all();

        $militares = Militar::select('militars.id', 'numero', 'nome_de_guerra', 'posto_id', 'antiguidade')->where('subunidade_id', $su)->join('postos', 'militars.posto_id', '=', 'postos.id')->
            orderBy('antiguidade', 'ASC')->orderBy('numero', 'asc')->where('situacao', 'ativa')->get();        
        return view('militares.index',compact('user_auth', 'militares', 'su', 'search', 'subunidades', 'search_su'));
    }

    public function criar()
    {
        $postos = Posto::all();
        $subunidades = Subunidade::all();
        $pelotoes = Pelotao::all();
        $qms = QualificacaoMilitar::all();
        return view('militares.create',compact('postos', 'subunidades', 'pelotoes', 'qms'));
    }

    public function create()
    {
        $postos = Posto::orderBy('antiguidade', 'ASC')->get();
        $subunidades = Subunidade::all();
        $pelotoes = Pelotao::all();
        $qms = QualificacaoMilitar::all();
        return view('militares.create',compact('postos', 'subunidades', 'pelotoes', 'qms'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required',
            'nome_de_guerra' => 'required',
            'cpf' => 'required',
            'endereco' => 'required',
            'contato' => 'required',
            //'responsavel' => 'required',
            'posto_id' => 'required',
            'pelotao_id' => 'required',
            'subunidade_id' => 'required',
            'data_nascimento' => 'required',
            'qualificacao_militar_id' => 'required',
            'turma' => 'required',
        ]);

        $militar = Militar::create(['nome' => $request->input('nome'), 'nome_de_guerra' => strtoupper($request->input('nome_de_guerra')),
        'numero' => $request->input('numero'), 'cpf' => $request->input('cpf'), 'idt_militar' => $request->input('idt_militar'),
        'endereco' => $request->input('endereco'), 'contato' => $request->input('contato'), 'responsavel' => $request->input('responsavel'),
         'posto_id' => $request->input('posto_id'), 'pelotao_id' => $request->input('pelotao_id'), 'subunidade_id' => $request->input('subunidade_id'),
         'tipo_sanguineo' => $request->input('tipo_sanguineo'), 'data_nascimento' => $request->input('data_nascimento'), 'turma' => $request->input('turma'), 'qualificacao_militar_id' => $request->input('qualificacao_militar_id')]);

        return redirect()->route('militares.index')
                        ->with('success','Militar cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $militar = Militar::find($id);
        $postos = Posto::all();
        $subunidades = Subunidade::all();
        $pelotoes = Pelotao::all();
        $qms = QualificacaoMilitar::all();
        return view('militares.edit',compact('militar','postos', 'subunidades', 'pelotoes', 'qms'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nome' => 'required',
            'nome_de_guerra' => 'required',
            //'numero' => 'required',
            //'cpf' => 'required',
            'endereco' => 'required',
            //'contato' => 'required',
            //'responsavel' => 'required',
            'situacao' => 'required',
            'posto_id' => 'required',
            'pelotao_id' => 'required',
            'subunidade_id' => 'required',
            'data_nascimento' => 'required',
            'qualificacao_militar_id' => 'required',
            'turma' => 'required',
        ]);

        $militar = Militar::find($id);
        $militar->nome = $request->input('nome');
        $militar->nome_de_guerra = strtoupper($request->input('nome_de_guerra'));
        $militar->numero = $request->input('numero');
        $militar->cpf = $request->input('cpf');
        $militar->endereco = $request->input('endereco');
        $militar->contato = $request->input('contato');
        $militar->responsavel = $request->input('responsavel');
        $militar->idt_militar = $request->input('idt_militar');
        $militar->situacao = $request->input('situacao');
        $militar->posto_id = $request->input('posto_id');
        $militar->pelotao_id = $request->input('pelotao_id');
        $militar->subunidade_id = $request->input('subunidade_id');
        $militar->data_nascimento = $request->input('data_nascimento');
        $militar->tipo_sanguineo = $request->input('tipo_sanguineo');
        $militar->turma = $request->input('turma');
        $militar->qualificacao_militar_id = $request->input('qualificacao_militar_id');

        $militar->save();

        return redirect()->route('militares.edit', $militar->id)
                        ->with('success','Militar atualizado com Sucesso!');
    }
}
