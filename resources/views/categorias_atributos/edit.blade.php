@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Categoria de Atributos</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-white" href="{{ route('categorias_avaliacoes.index') }}"><img
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

    {!! Form::model($categoria_atributo, [
        'method' => 'PATCH',
        'route' => ['categorias_atributos.update', $categoria_atributo->id],
    ]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group row justify-content-center">
                <div class="col-6">
                    <strong>Nome:</strong>
                    {!! Form::text('nome', null, ['placeholder' => 'Ex: Avaliação de Oficiais', 'class' => 'form-control col-3']) !!}
                </div>
                <div class="col-3">
                    <strong>Peso:</strong>
                    {!! Form::number('peso', null, [
                        'placeholder' => 'Ex: 1',
                        'min' => 1,
                        'step' => 1,
                        'class' => 'form-control col-3',
                    ]) !!}
                </div>
                <div class="col-3">
                    <strong>Status:</strong>
                    <select name="status" class="form-select">
                        @if ($categoria_atributo->status == 1)
                            <option value="1" selected>
                                Ativa
                            </option>
                            <option value="2">
                                Inativa
                            </option>
                        @else
                            <option value="1">
                                Ativa
                            </option>
                            <option value="2" selected>
                                Inativa
                            </option>
                        @endif
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Concluir</button>
        </div>
    </div>
    {!! Form::close() !!}

@endsection
