@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Definir atributos da {{ $categoria_avaliacao->nome }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-white" href="{{ route('categorias_avaliacoes.index') }}"><img
                        src="{{ url('storage/icons/back.png') }}" height="20"> Voltar</a>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Atenção!</strong> Um erro inesperado aconteceu, informe a Assessoria de Gestão.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::open(['route' => 'categorias_avaliacoes.definir_store', 'method' => 'POST']) !!}
    <div class="row">
        <input value="{{ $categoria_avaliacao->id }}" name="categoria_avaliacao_id" type="text" class="d-none" readonly>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group row justify-content-center">
                <div class="col-12">
                    <div class="row">
                        <h1 class="title-sipam font-large text-center"><strong>Selecione os Atributos que pertencem a
                                Avaliação:</strong></h1>

                        @foreach ($atributos as $atributo)
                            <div class="card-atributos font-large cursor-pointer col-4">
                                <h3 class="font-small text-center">{{ $atributo->categoria_atributo->nome }}</h3>
                                <label
                                    class="cursor-pointer col">{{ Form::checkbox('atributos[]', $atributo->id, $categoria_avaliacao->possuiAtributo($atributo->id) ? true : false, ['class' => 'name checkbox']) }}
                                    {{ $atributo->nome }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </div>
    </div>
    {!! Form::close() !!}

@endsection
