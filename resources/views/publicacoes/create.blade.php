@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Adicionar Publicação</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-white" href="{{ route('publicacoes.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
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


{!! Form::open(array('route' => 'publicacoes.store','method'=>'POST')) !!}
<div class="row justify-content-center">
    <div class="col-3">
        <div class="form-group">
            <strong>Documento</strong>
            <select class="form-select" name="tipo">
                <option value="BI">BI</option>
                <option value="Adt BI">Adt BI</option>
                <option value="BAR">BAR</option>
                <option value="Adt BAR">Adt BAR</option>
                <option value="Adt S3">Adt S3</option>
            </select>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <strong>Número do documento:</strong>
            {!! Form::number('numero', null, array('placeholder' => 'Ex: 10','class' => 'form-control', 'min' => 1, 'step' => 1, 'required' => 'required')) !!}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <strong>Data do documento:</strong>
            {!! Form::date('data', date('Y-m-d'), array('class' => 'form-control', 'required' => 'required')) !!}
        </div>
    </div>
    <div class="col-9">
        <div class="form-group">
            <strong>Assunto da publicação:</strong>
            {!! Form::text('assunto', null, array('placeholder' => 'Ex: Publicação de TAF dos Of/ST/Sgt','class' => 'form-control', 'required' => 'required')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </div>
</div>
{!! Form::close() !!}

@endsection
