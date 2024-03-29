<?php

namespace App\Http\Controllers;

use App\Models\Fracao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FracaoController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:admin', ['only' => ['index','store', 'create', 'update']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $user_auth = Auth::user();
        $fracoes = Fracao::all();
        return view('fracoes.index', compact('fracoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_auth = Auth::user();
        $users = User::whereHas(
            'roles', function($q){
                $q->where('name', 'Cmt Fração');
            }
        )->get();

        return view('fracoes.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user_auth = Auth::user();
        $this->validate($request, [
            'nome' => 'required',
            'user_id' => 'required',
        ]);

        Fracao::create(['nome' => $request->input('nome'), 'user_id' => $request->input('user_id')]);

        return redirect()
            ->route('fracoes.index')
            ->with('success', 'Fração cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user_auth = Auth::user();
        $fracao = Fracao::find($id);
        $users = User::whereHas(
            'roles', function($q){
                $q->where('name', 'Cmt Fração');
            }
        )->get();
        return view('fracoes.edit', compact('users', 'fracao'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user_auth = Auth::user();
        $this->validate($request, [
            'nome' => 'required',
            'user_id' => 'required',
            'status' => 'required'
        ]);

        $fracao = Fracao::find($id);
        $fracao->nome = $request->input('nome');
        $fracao->user_id = $request->input('user_id');
        $fracao->status = $request->input('status');
        $fracao->save();
        
        return redirect()
            ->route('fracoes.index')
            ->with('success', 'Fração atualizada com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
