<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Militar;
use App\Models\Subunidade;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Auth;

class SubunidadeController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:subunidade-list|subunidade-create|subunidade-edit|subunidade-delete', ['only' => ['index','store']]);
         $this->middleware('permission:subunidade-create', ['only' => ['create','store']]);
         $this->middleware('permission:subunidade-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:subunidade-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $user_auth = Auth::user();
        $data = Subunidade::orderBy('nome','ASC')->paginate(5);
        return view('subunidades.index',compact('data','user_auth'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('subunidades.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|unique:subunidades,nome',
            'cmt_subunidade' => 'required|unique:subunidades,cmt_subunidade',
        ]);

        $subunidade = Subunidade::create(['nome' => $request->input('nome'), 'cmt_subunidade' => $request->input('cmt_subunidade')]);

        return redirect()->route('subunidades.index')
                        ->with('success','Subunidade cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $subunidade = Subunidade::find($id);

        return view('subunidades.edit',compact('subunidade'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nome' => 'required',
            'cmt_subunidade' => 'required',
        ]);

        $subunidade = Subunidade::find($id);
        $subunidade->nome = $request->input('nome');
        $subunidade->cmt_subunidade = $request->input('cmt_subunidade');
        $subunidade->save();

        return redirect()->route('subunidades.index')
                        ->with('success','Subunidade atualizada com Sucesso!');
    }
}
