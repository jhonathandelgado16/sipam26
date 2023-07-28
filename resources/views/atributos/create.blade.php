@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Adicionar Atributo</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-white" href="{{ route('atributos.index') }}"><img
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


    {!! Form::open(['route' => 'atributos.store', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group row justify-content-center">
                <div class="col-6">
                    <strong>Nome:</strong>
                    {!! Form::text('nome', null, ['placeholder' => 'Ex: Responsabilidade', 'class' => 'form-control col-3']) !!}
                </div>
                <div class="col-4">
                    <strong>Categoria do Atributo:</strong>
                    <select name="categoria_atributo_id" class="form-select">
                        <option value="" selected>
                            Selecione a Categoria
                        </option>
                        @foreach ($categorias_atributos as $key => $categoria_atributo)
                        <option value="{{$categoria_atributo->id}}">
                            {{$categoria_atributo->nome}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </div>
    </div>
    {!! Form::close() !!}

@endsection
