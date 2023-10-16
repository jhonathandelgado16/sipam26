<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Escolaridade;
use App\Models\Militar;
use App\Models\MilitarCurso;
use App\Models\MilitarEscolaridade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MilitarCursoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:militar-edit', ['only' => ['index', 'store', 'create']]);
    }

    public function index($id)
    {
        $user_auth = Auth::user();
        $militar = Militar::find($id);
        $cursos_pontuando = MilitarCurso::where('militar_id', $id)
            ->where('pontuando', 1)
            ->whereYear('data_conclusao', '=', date('Y'))
            ->get();
        $cursos_nao_pontuando = MilitarCurso::where('militar_id', $id)
            ->where('pontuando', '!=', 1)
            ->orwhere('militar_id', $id)
            ->whereYear('data_conclusao', '!=', date('Y'))
            ->get();
        return view('ficha_sipam.cursos.index', compact('militar', 'cursos_pontuando', 'cursos_nao_pontuando'));
    }

    public function create($id)
    {
        $user_auth = Auth::user();
        $militar = Militar::find($id);
        $curso = '';
        return view('ficha_sipam.cursos.create', compact('militar', 'curso'));
    }

    public function createComCurso($id, $curso_id)
    {
        $user_auth = Auth::user();
        $militar = Militar::find($id);
        $curso = Curso::find($curso_id);
        return view('ficha_sipam.cursos.create', compact('militar', 'curso'));
    }

    public function encontrar($id)
    {
        $user_auth = Auth::user();
        $militar = Militar::find($id);
        $pesquisa = '';
        $cursos = '';
        return view('ficha_sipam.cursos.find', compact('militar', 'cursos', 'pesquisa'));
    }

    public function encontrarCurso($id, Request $request)
    {
        $user_auth = Auth::user();
        $militar = Militar::find($id);
        $pesquisa = $request->input('pesquisa');
        $cursos = Curso::whereNotIn(
            'id',
            MilitarCurso::select('curso_id')
                ->where('militar_id', $id)
                ->get()
                ->toArray(),
        )
            ->where('nome', 'LIKE', "%{$pesquisa}%")
            ->orWhere('instituicao_ensino', 'LIKE', "%{$pesquisa}%")
            ->whereNotIn(
                'id',
                MilitarCurso::select('curso_id')
                    ->where('militar_id', $id)
                    ->get()
                    ->toArray(),
            )
            ->orderBy('nome')
            ->get();
        return view('ficha_sipam.cursos.find', compact('militar', 'cursos', 'pesquisa'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required',
            'horas' => 'required',
            'data_conclusao' => 'required',
            'instituicao_ensino' => 'required',
            'militar_id' => 'required',
        ]);

        if ($request->input('curso_id') == '') {
            $buscaCurso = Curso::whereRaw('(UPPER(`nome`) LIKE "' . strtoupper($request->input('nome')) . '") AND (UPPER(`instituicao_ensino`) LIKE "' . strtoupper($request->input('instituicao_ensino')) . '") AND (horas = "'.  $request->input('horas') . '")')->first();

            if ($buscaCurso) {
                return redirect()
                    ->route('cursos.encontrar', $request->input('militar_id'))
                    ->with('danger', 'Esse curso já está cadastrado no sistema, por favor pesquise o curso novamente!');
            }

            $curso = Curso::create(['nome' => $request->input('nome'), 'horas' => $request->input('horas'), 'instituicao_ensino' => strtoupper($request->input('instituicao_ensino'))]);
            $curso_id = $curso->id;
        } else {
            $curso_id = $request->input('curso_id');
        }


        if ($request->input('curso_id') == '') {
            $situacao_aprovado = '2';
        } else {
            $curso = Curso::find($curso_id);

            if($curso->aprovado == '1'){
                $situacao_aprovado = '1';
            } else {
                $situacao_aprovado = '4';
            }
        }

        $militar_curso = MilitarCurso::create(['data_conclusao' => $request->input('data_conclusao'), 'curso_id' => $curso_id, 'militar_id' => $request->input('militar_id'), 'pontuando' => $situacao_aprovado]);

        return redirect()
            ->route('ficha_sipam.curso_index', $request->input('militar_id'))
            ->with('success', 'Curso lançado com sucesso!');
    }

    public function aprovarCurso(Request $request)
    {
        $this->validate($request, [
            'curso_id' => 'required',
        ]);

        $curso = Curso::find($request->input('curso_id'));
        $curso->aprovado = 1;
        $curso->save();

        $militares_cursos = MilitarCurso::where('curso_id', $request->input('curso_id'))->get();
        foreach ($militares_cursos as $militar_curso) {
            $militar_curso->pontuando = 1;
            $militar_curso->save();
        }

        return redirect()
            ->route('cursos.index')
            ->with('success', $curso->nome . ' está pontuando!');
    }

    public function reprovarCurso(Request $request)
    {
        $this->validate($request, [
            'curso_id' => 'required',
        ]);

        $curso = Curso::find($request->input('curso_id'));
        $curso->aprovado = 3;
        $curso->save();

        $militares_cursos = MilitarCurso::where('curso_id', $request->input('curso_id'))->get();
        foreach ($militares_cursos as $militar_curso) {
            $militar_curso->pontuando = 4;
            $militar_curso->save();
        }

        return redirect()
            ->route('cursos.index')
            ->with('success', $curso->nome . ' não está pontuando!');
    }
}
