@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Adicionar Novo Posto/Graduação</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-white" href="{{ route('postos.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
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


{!! Form::open(array('route' => 'postos.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-8 col-sm-8 col-md-8">
        <div class="form-group">
            <strong>Posto/Graduação:</strong>
            {!! Form::text('posto', null, array('placeholder' => 'Posto/Graduação','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Antiguidade:</strong>
            {!! Form::number('antiguidade', null, array('placeholder' => 'Antiguidade','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </div>
</div>
{!! Form::close() !!}

@endsection
