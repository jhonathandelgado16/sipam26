@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Curso de Formação</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-white" href="{{ route('cursos_formacao.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Erro inesperado!</strong> Entre em contato com a Assessoria de Gestão para notificar o erro
            encontrado.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

{!! Form::model($curso_formacao, ['method' => 'PATCH','route' => ['cursos_formacao.update', $curso_formacao->id]]) !!}
<div class="row justify-content-center">
    <div class="col-5">
        <div class="form-group">
            <strong>Nome do Curso de Formação:</strong>
            {!! Form::text('nome', $curso_formacao->nome, array('placeholder' => 'Ex: CFC','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <strong>Pontos:</strong>
            {!! Form::number('pontos', $curso_formacao->pontos, array('placeholder' => 'Ex: 0.20','class' => 'form-control', 'step' => 0.01, 'min' => 0)) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Concluir</button>
    </div>
</div>
{!! Form::close() !!}


@endsection
