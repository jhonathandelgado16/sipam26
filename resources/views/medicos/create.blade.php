@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Adicionar Novo Médico</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-white" href="{{ route('medicos.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
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


{!! Form::open(array('route' => 'medicos.store','method'=>'POST')) !!}
<div class="row justify-content-center">
    <div class="col-4">
        <strong>Posto/Graduação:</strong>
        <select name="posto_id" class="form-select">
            @foreach ($postos as $key => $posto)
                <option value="{{$posto->id}}">
                    {{$posto->posto}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-6">
        <div class="form-group">
            <strong>Nome:</strong>
            {!! Form::text('nome', null, array('placeholder' => 'Nome de Guerra','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </div>
</div>
{!! Form::close() !!}

@endsection
