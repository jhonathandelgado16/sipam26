<?php

namespace App\Http\Controllers;

use App\Models\Fracao;
use App\Models\User;
use Illuminate\Http\Request;

class FracaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $fracoes = Fracao::all();
        return view('fracoes.index', compact('fracoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
