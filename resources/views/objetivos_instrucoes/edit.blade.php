@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Objetivos Individuais das Instruções</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-white" href="{{ route('objetivos_instrucoes.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
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


{!! Form::model($objetivo_instrucao, ['method' => 'PATCH','route' => ['objetivos_instrucoes.update', $objetivo_instrucao->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group row justify-content-center">
            <div class="col-2">
                <strong>Matéria:</strong>
                {!! Form::text('materia', null, array('placeholder' => 'Ex: 1.','class' => 'form-control')) !!}
            </div>

            <div class="col-2">
                <strong>Identificacao:</strong>
                {!! Form::text('identificacao', null, array('placeholder' => 'Ex: B-101','class' => 'form-control')) !!}
            </div>

            <div class="col-4">
                <strong>Referência:</strong>
                {!! Form::text('referencia', null, array('placeholder' => 'Ex: EB70-PP-11.011','class' => 'form-control')) !!}
            </div>

            <div class="col-4">
                <strong>Definir qual QM do Objetivo Individual:</strong>
                <select name="dentro_da_fiib" class="form-select">
                    <option value="0" @if($objetivo_instrucao->dentro_da_fiib == 0) selected @endif>
                        Inativo
                    </option>
                    <option value="50" @if($objetivo_instrucao->dentro_da_fiib == 50) selected @endif>
                        Instrução Individual de Qualificação
                    </option>
                    @foreach ($qms as $qm)
                    @if($objetivo_instrucao->dentro_da_fiib == $qm->id)
                                <option value="{{$qm->id}}" selected>
                                    {{$qm->qualificacao . ' - ' . $qm->descricao}}
                                </option>
                            @else
                                <option value="{{$qm->id}}">
                                    {{$qm->qualificacao . ' - ' . $qm->descricao}}
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
