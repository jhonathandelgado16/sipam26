<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posto;
use App\Models\Vacina;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Auth;
class VacinaController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:admin', ['only' => ['index','store']]);
         $this->middleware('permission:admin', ['only' => ['create','store']]);
         $this->middleware('permission:admin', ['only' => ['edit','update']]);
         $this->middleware('permission:admin', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $user_auth = Auth::user();
        $vacinas = Vacina::all();
        return view('vacinas.index',compact('vacinas','user_auth'));
    }

    public function create()
    {
        return view('vacinas.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'vacina' => 'required|unique:vacinas,vacina',
        ]);

        $vacina = Vacina::create(['vacina' => $request->input('vacina')]);

        return redirect()->route('vacinas.index')
                        ->with('success','Vacina cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $vacina = Vacina::find($id);

        return view('vacinas.edit',compact('vacina'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'vacina' => 'required',
        ]);

        $vacina = Vacina::find($id);
        $vacina->vacina = $request->input('vacina');
        $vacina->save();

        return redirect()->route('vacinas.index')
                        ->with('success','Vacina atualizada com Sucesso!');
    }
}
