@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Atributos</h2>
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

    {!! Form::model($atributo, [
        'method' => 'PATCH',
        'route' => ['atributos.update', $atributo->id],
    ]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group row justify-content-center">
                <div class="col-4">
                    <strong>Nome:</strong>
                    {!! Form::text('nome', null, ['placeholder' => 'Ex: Responsabilidade', 'class' => 'form-control col-12']) !!}
                </div>

                <div class="col-2">
                    <strong>Status:</strong>
                    <select name="status" class="form-select">
                        @if ($atributo->status == 1)
                            <option value="1" selected>
                                Ativo
                            </option>
                            <option value="2">
                                Inativo
                            </option>
                        @else
                            <option value="1">
                                Ativo
                            </option>
                            <option value="2" selected>
                                Inativo
                            </option>
                        @endif
                    </select>
                </div>
                
                <div class="col-3">
                    <strong>Categoria do Atributo:</strong>
                    <select name="categoria_atributo_id" class="form-select">
                        @foreach ($categorias_atributos as $key => $categoria_atributo)
                            @if($atributo->categoria_atributo_id == $categoria_atributo->id)
                                <option value="{{$categoria_atributo->id}}" selected>
                                    {{$categoria_atributo->nome}}
                                </option>
                            @else
                                <option value="{{$categoria_atributo->id}}">
                                    {{$categoria_atributo->nome}}
                                </option>
                            @endif
                        @endforeach
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
