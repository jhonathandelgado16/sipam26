<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\MilitarCurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CursoController extends Controller
{
    //
    function __construct()
    {
        $this->middleware('permission:admin', ['only' => ['index', 'store', 'create']]);
    }

    public function index()
    {
        $user_auth = Auth::user();
        $cursos_pontuando = Curso::where('aprovado', 1)->get();
        $cursos_aguardando = Curso::where('aprovado', 2)->get();
        $cursos_nao_pontuando = Curso::where('aprovado', 3)->get();
        return view('cursos.index', compact('cursos_pontuando', 'cursos_aguardando', 'cursos_nao_pontuando'));
    }
}
