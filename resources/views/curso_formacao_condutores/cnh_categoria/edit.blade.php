@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Categoria de CNH</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-white" href="{{ route('cnh_categorias.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
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

{!! Form::model($cnh_categoria, ['method' => 'PATCH','route' => ['cnh_categorias.update', $cnh_categoria->id]]) !!}
<div class="row justify-content-center">
    <div class="col-5">
        <div class="form-group">
            <strong>Nome da Categoria de CNH:</strong>
            {!! Form::text('categoria', $cnh_categoria->categoria, array('placeholder' => 'Ex: E','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <strong>Pontos:</strong>
            {!! Form::number('pontos', $cnh_categoria->pontos, array('placeholder' => 'Ex: 0.20','class' => 'form-control', 'step' => 0.01, 'min' => 0)) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Concluir</button>
    </div>
</div>
{!! Form::close() !!}


@endsection
