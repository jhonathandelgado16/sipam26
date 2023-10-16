@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Menção de TAF</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-white" href="{{ route('mencoes_taf.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
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

{!! Form::model($mencao, ['method' => 'PATCH','route' => ['mencoes_taf.update', $mencao->id]]) !!}
<div class="row justify-content-center">
    <div class="col-3">
        <div class="form-group">
            <strong>Menção:</strong>
            {!! Form::text('mencao', $mencao->mencao, array('placeholder' => 'Ex: E','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <strong>Pontos:</strong>
            {!! Form::number('pontos', $mencao->pontos, array('placeholder' => 'Ex: 0.20','class' => 'form-control', 'step' => 0.01, 'min' => 0)) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Concluir</button>
    </div>
</div>
{!! Form::close() !!}


@endsection
