@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Adicionar Número de TAF</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-white" href="{{ route('taf_numeros.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
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


{!! Form::open(array('route' => 'taf_numeros.store','method'=>'POST')) !!}
<div class="row justify-content-center">
    <div class="col-3">
        <div class="form-group">
            <strong>Número do TAF:</strong>
            {!! Form::text('numero', null, array('placeholder' => 'Ex: 1º TAF','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </div>
</div>
{!! Form::close() !!}

@endsection
