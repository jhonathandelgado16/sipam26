<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pelotao;
use App\Models\Subunidade;
use DB;
use Illuminate\Support\Facades\Auth;

class PelotaoController extends Controller
{
    //

    function __construct()
    {
         $this->middleware('permission:pelotao-list|pelotao-create|pelotao-edit|pelotao-delete', ['only' => ['index','store']]);
         $this->middleware('permission:pelotao-create', ['only' => ['create','store']]);
         $this->middleware('permission:pelotao-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:pelotao-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $user_auth = Auth::user();
        $pelotoes = Pelotao::all();
        return view('pelotoes.index',compact('pelotoes','user_auth'));
    }

    public function create()
    {
        $subunidades = Subunidade::all();
        return view('pelotoes.create', compact('subunidades'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'pelotao' => 'required',
            'cmt_pelotao' => 'required',
            'subunidade' => 'required',
        ]);

        $pelotao = Pelotao::create(['pelotao' => $request->input('pelotao'), 'cmt_pelotao' => $request->input('cmt_pelotao'), 'subunidade_id' => $request->input('subunidade')]);

        return redirect()->route('pelotoes.index')
                        ->with('success','Pelotão cadastrado com sucesso!');
    }
/*
    public function edit($id)
    {
        $posto = Posto::find($id);

        return view('postos.edit',compact('posto'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'posto' => 'required',
            'antiguidade' => 'required',
        ]);

        $posto = Posto::find($id);
        $posto->posto = $request->input('posto');
        $posto->antiguidade = $request->input('antiguidade');
        $posto->save();

        return redirect()->route('postos.index')
                        ->with('success','Posto/Graduação atualizado com Sucesso!');
    }
    */
}
