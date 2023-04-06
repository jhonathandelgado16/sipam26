@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Médico</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-white" href="{{ route('medicos.index') }}"><img src="{{url('storage/icons/back.png')}}"
                    height="20"> Voltar</a>
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


{!! Form::model($medico, ['method' => 'PATCH','route' => ['medicos.update', $medico->id]]) !!}
<div class="row justify-content-center">
    <div class="col-3">
        <strong>Posto/Graduação:</strong>
        <select name="posto_id" class="form-select">
            @foreach ($postos as $key => $posto)
            @if($medico->posto_id == $posto->id)
            <option value="{{$posto->id}}" selected>
                {{$posto->posto}}
            </option>
            @else
            <option value="{{$posto->id}}">
                {{$posto->posto}}
            </option>
            @endif
            @endforeach
        </select>
    </div>

    <div class="col-2">
        <strong>Situação:</strong>
        <select name="situacao" class="form-select">
            @if($medico->situacao == 'ATIVA')
            <option value="ATIVA" selected>
                Ativa
            </option>
            <option value="INATIVO">
                Inativo
            </option>
            @else
            <option value="ATIVA">
                Ativa
            </option>
            <option value="INATIVO" selected>
                Inativo
            </option>
            @endif
        </select>
    </div>

    <div class="col-5">
        <div class="form-group">
            <strong>Nome:</strong>
            {!! Form::text('nome', null, array('placeholder' => 'Nome de Guerra','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Concluir</button>
    </div>
</div>
{!! Form::close() !!}


@endsection
