<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posto;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Auth;

class PostoController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:posto-list|posto-create|posto-edit|posto-delete', ['only' => ['index','store']]);
         $this->middleware('permission:posto-create', ['only' => ['create','store']]);
         $this->middleware('permission:posto-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:posto-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $user_auth = Auth::user();
        $postos = Posto::orderBy('antiguidade','ASC')->get();
        return view('postos.index',compact('postos','user_auth'));
    }

    public function create()
    {
        return view('postos.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'posto' => 'required|unique:postos,posto',
            'antiguidade' => 'required|unique:postos,antiguidade',
        ]);

        $posto = Posto::create(['posto' => $request->input('posto'), 'antiguidade' => $request->input('antiguidade')]);

        return redirect()->route('postos.index')
                        ->with('success','Posto/Graduação cadastrado com sucesso!');
    }

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
}
