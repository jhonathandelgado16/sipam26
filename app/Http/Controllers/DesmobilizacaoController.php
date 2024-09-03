<?php

namespace App\Http\Controllers;

use App\Models\CnhMilitar;
use App\Models\Militar;
use App\Models\MilitarCurso;
use App\Models\MilitarEscolaridade;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Storage;

class DesmobilizacaoController extends Controller
{
    //
    public function curriculo(Request $request, $id)
    {
        $militar = Militar::find($id);
        $escolaridade = MilitarEscolaridade::select('escolaridades.nome', 'escolaridades.pontos', 'militar_escolaridades.instituicao_ensino')->where('militar_id', $id)->join('escolaridades', 'escolaridades.id', '=', 'militar_escolaridades.escolaridade_id')->orderBy('escolaridades.pontos', 'desc')->first();
        $cursos = MilitarCurso::select('curso_id', 'data_conclusao', 'pontuando', 'cursos.horas')->where('militar_id', $id)->where('pontuando', 1)->join('cursos', 'cursos.id', '=', 'militar_cursos.curso_id')->orderBy('cursos.horas','DESC')->get();
        $cnh_militar = CnhMilitar::where('militar_id', $militar->id)->join('cnh_categorias', 'cnh_categorias.id', '=', 'cnh_militars.cnh_categoria_id')->orderBy('pontos', 'DESC')->first();
            // dd($cursos);

            require_once '../../../vendor/autoload.php';

            //Instanciar o PhpWord
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('curriculos/modelo-2.docx');
            
            $templateProcessor->setValue('nome', $militar->nome);
            $templateProcessor->setValue('contato', $militar->contato);
            $templateProcessor->setValue('endereco', $militar->endereco);

            if ($escolaridade != null) {
                $templateProcessor->setValue('escolaridade', $escolaridade->nome);
            } else {
                $templateProcessor->setValue('escolaridade', "Formação");
            }
            
            $i = 1;
            foreach ($cursos as $curso) {
                $templateProcessor->setValue('curso#'.$i, $curso->curso->nome .', carga horária: '. $curso->horas . ' horas - '. $curso->curso->instituicao_ensino);
                $i++;
            }
            
            for ($i ; $i <= 8 ; $i++) { 
                $templateProcessor->setValue('curso#'.$i, '');
            }

            $nome = $militar->nome;

            $nome_arquivo = str_replace(" ", "_", $militar->nome);            
            //Gerar o arquivo Word com PHP
            $templateProcessor->saveAs('curriculos/prontos/'.$nome_arquivo .'_CV.docx');
            $filepath = public_path('curriculos/prontos/'). $nome_arquivo . "_CV.docx";
        
            return FacadesResponse::download($filepath);

        //return Storage::download('file.jpg');

        //return view('desmobilizacao.curriculo', compact('escolaridade','militar', 'cursos', 'cnh_militar'));       
    }
}
