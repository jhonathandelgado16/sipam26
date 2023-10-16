@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Publicação</h2>
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

{!! Form::model($publicacao, ['method' => 'PATCH','route' => ['publicacoes.update', $publicacao->id]]) !!}
<div class="row justify-content-center">
    <div class="col-3">
        <div class="form-group">
            <strong>Documento</strong>
            <select class="form-select" name="tipo">
                <option value="BI" @if($publicacao->tipo == 'BI') selected @endif>BI</option>
                <option value="Adt BI" @if($publicacao->tipo == 'Adt BI') selected @endif>Adt BI</option>
                <option value="BAR" @if($publicacao->tipo == 'BAR') selected @endif>BAR</option>
                <option value="Adt BAR" @if($publicacao->tipo == 'Adt BAR') selected @endif>Adt BAR</option>
                <option value="Adt S3" @if($publicacao->tipo == 'Adt S3') selected @endif>Adt S3</option>
            </select>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <strong>Número do documento:</strong>
            {!! Form::number('numero', $publicacao->numero, array('placeholder' => 'Ex: 10','class' => 'form-control', 'min' => 1, 'step' => 1, 'required' => 'required')) !!}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <strong>Data do documento:</strong>
            {!! Form::date('data', $publicacao->data, array('class' => 'form-control', 'required' => 'required')) !!}
        </div>
    </div>
    <div class="col-9">
        <div class="form-group">
            <strong>Assunto da publicação:</strong>
            {!! Form::text('assunto', $publicacao->assunto, array('placeholder' => 'Ex: Publicação de TAF dos Of/ST/Sgt','class' => 'form-control', 'required' => 'required')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</div>
{!! Form::close() !!}


@endsection
