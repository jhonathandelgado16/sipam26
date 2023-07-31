@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Adicionar Escolaridade</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-white" href="{{ route('escolaridades.index') }}"><img
                        src="{{ url('storage/icons/back.png') }}" height="20"> Voltar</a>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::open(['route' => 'escolaridades.store', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group row justify-content-center">
                <div class="col-6">
                    <strong>Nome:</strong>
                    {!! Form::text('nome', null, ['placeholder' => 'Ex: Ensino Médio Completo', 'class' => 'form-control col-3']) !!}
                </div>
                <div class="col-3">
                    <strong>Pontos:</strong>
                    {!! Form::number('pontos',0.5, ['placeholder' => 'Ex: 1', 'min' => 0.5, 'step' => 0.5, 'class' => 'form-control col-3']) !!}
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </div>
    </div>
    {!! Form::close() !!}

@endsection
