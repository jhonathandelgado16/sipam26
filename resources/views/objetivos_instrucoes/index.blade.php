@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
    <div class="row">
        <div class="pull-left col-8">
            <h2>Controle de Objetivos Individuais das Instruções</h2>
        </div>
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <div class="pull-right col-8">
                    <a class="btn btn-white" href="{{ route('admins.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
                </div>
                <div class="row justify-content-end col-4">
                    @can('admin')
                        <a class="col-7 btn btn-primary" href="{{ route('objetivos_instrucoes.create') }}"> Adicionar OII</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="row justify-content-end col-4">

        </div>
    </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<table class="table text-center">
    <tr>
        <th>OII</th>
        <th>Referência</th>
        <th width="280px">Ações</th>
    </tr>

    @foreach ($objetivos_instrucoes as $key => $objetivo_instrucao)
    <tr>
        <td>{{ $objetivo_instrucao->getOII() }}</td>
        <td>{{ $objetivo_instrucao->referencia }}</td>
        <td>
            @can('admin')
                <a class="btn btn-white" href="{{ route('objetivos_instrucoes.edit',$objetivo_instrucao->id) }}"><img src="{{url('storage/icons/edit.png')}}" height="20"> Editar</a>
            @endcan
        </td>
    </tr>
    @endforeach
</table>

@endsection
