@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Adicionar Categoria de CNH</h2>
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


{!! Form::open(array('route' => 'cnh_categorias.store','method'=>'POST')) !!}
<div class="row justify-content-center">
    <div class="col-5">
        <div class="form-group">
            <strong>Nome da Categoria</strong>
            {!! Form::text('categoria', null, array('placeholder' => 'Ex: C','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <strong>Pontos:</strong>
            {!! Form::number('pontos', null, array('placeholder' => 'Ex: 2','class' => 'form-control', 'step' => 0.1, 'min' => 0.1)) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </div>
</div>
{!! Form::close() !!}

@endsection
