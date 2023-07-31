@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Escolaridade</h2>
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

    {!! Form::model($escolaridade, [
        'method' => 'PATCH',
        'route' => ['escolaridades.update', $escolaridade->id],
    ]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group row justify-content-center">
                <div class="col-6">
                    <strong>Nome:</strong>
                    {!! Form::text('nome', null, ['placeholder' => 'Ex: Ensino Médio Completo', 'class' => 'form-control col-3']) !!}
                </div>
                <div class="col-3">
                    <strong>Pontos:</strong>
                    {!! Form::number('pontos', null, [
                        'placeholder' => 'Ex: 1',
                        'min' => 0.5,
                        'step' => 0.5,
                        'class' => 'form-control col-3',
                    ]) !!}
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Concluir</button>
        </div>
    </div>
    {!! Form::close() !!}

@endsection
