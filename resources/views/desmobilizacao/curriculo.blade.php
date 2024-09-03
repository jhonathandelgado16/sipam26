@extends('layouts.app')

@section('content')

@php

//Incluir a biblioteca PhpWord usando o Composer
require_once '../../../vendor/autoload.php';

//Instanciar o PhpWord
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('curriculos/modelo-2.docx');

$templateProcessor->setValue('nome', $militar->nome);
$templateProcessor->setValue('contato', $militar->contato);
$templateProcessor->setValue('endereco', $militar->endereco);
$templateProcessor->setValue('escolaridade', $escolaridade->nome);

$i = 1;
foreach ($cursos as $curso) {
    $templateProcessor->setValue('curso#'.$i, $curso->curso->nome .', '. $curso->horas . ' horas, '. $curso->curso->instituicao_ensino);
    $i++;
}

for ($i ; $i <= 8 ; $i++) { 
    $templateProcessor->setValue('curso#'.$i, '');
}

//Gerar o arquivo Word com PHP
$templateProcessor->saveAs('curriculos/prontos/'.$militar->nome .'.docx');

@endphp

<div class="col-12 d-print-block cv-card">
    <div class="row">
        <div class="col-6 cv-left-side">
            <div class="row">
                <div class="offset-3 col-6 row justify-content-center margin-bottom-5 margin-top-40">
                    <img class="col-12" src="{{ url('storage/cv-perfil.png') }}">
                </div>
                <div class="text-center margin-bottom-5">
                    <h4 class="cv-name">{{ $militar->nome }}</h4>
                </div>
                <div class="text-center margin-bottom-10">
                    <h3 class="cv-subtitle">VAGA-PROFISSÃO</h3>
                </div>
                <div class="text-justify offset-1 col-10 margin-bottom-15">
                    <h3 class="cv-text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam mattis, nisi eget porttitor suscipit, ligula justo suscipit sem, id condimentum nulla libero ac augue. Nulla facilisi. In mattis lorem ut laoreet consectetur. Morbi sed tortor a nulla pellentesque posuere ut sed arcu. Duis accumsan, quam ac aliquet elementum, tellus ipsum dignissim sem, et suscipit augue libero id est. Sed in fermentum erat. Sed sed tristique ipsum. Nullam fermentum, mi in pulvinar porta, ante dolor faucibus erat, ut ultricies lectus leo eu justo.
                    </h3>
                </div>
                <div class="margin-bottom-50 offset-1 col-10">
                    <h3 class="cv-subtitle">EDUCAÇÃO</h3>
                    <h3 class="cv-text">
                        <ion-icon name="school"></ion-icon> Cursando Ensino Superior - TSI - UTFPR
                    </h3>
                </div>

                <div class="offset-1 col-10 margin-bottom-50">
                    <h3 class="cv-text">
                        <ion-icon name="call"></ion-icon> {{ $militar->contato }}
                    </h3>
                    <h3 class="cv-text">
                        <ion-icon name="mail"></ion-icon> contato@email.com
                    </h3>
                    <h3 class="cv-text">
                        <ion-icon name="location"></ion-icon> {{ $militar->endereco }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-6 cv-right-side">

        </div>
        
    </div>
</div>


@endsection