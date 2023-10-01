<?php

namespace App\Http\Controllers;

use App\Models\Militar;
use App\Models\SocialVisita;
use Illuminate\Http\Request;

class SocialVisitaController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:militar-edit', ['only' => ['index', 'store', 'create']]);
    }

    public function index($id)
    {
        $militar = Militar::find($id);
        $visitas_sociais = SocialVisita::where('militar_id', $id)->get();
        return view('ficha_acompanhamento.visita_social.index', compact('militar', 'visitas_sociais'));
    }

    public function create($id){
        $militar = Militar::find($id);
        return view('ficha_acompanhamento.visita_social.create', compact('militar'));
    }

    public function store($id, Request $request){
        $militar = Militar::find($id);

        $this->validate($request, [
            'data' => 'required',
            'relato' => 'required',
        ]);

        SocialVisita::create([
            'data' => $request->input('data'),
            'relato' => $request->input('relato'),
            'militar_id' => $id,
        ]);

        return redirect()->route('visita_sociais.index', $id)->with('success', 'Visita Social inserida com sucesso!');
    }
}
