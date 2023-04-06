@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
    <div class="row">
        <div class="pull-left col-8">
            <h2>Controle de Médicos</h2>
        </div>
        <div class="row justify-content-end col-4">

        </div>
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <div class="pull-right col-8">
                    <a class="btn btn-white" href="{{ route('admins.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
                </div>
                <div class="row justify-content-end col-4">
                    @can('admin')
                        <a class="col-10 btn btn-primary" href="{{ route('medicos.create') }}"> Adicionar Médico</a>
                    @endcan
                </div>
            </div>
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
        <th>Posto/Grad</th>
        <th>Nome</th>
        <th>Situacao</th>
        <th width="280px">Ações</th>
    </tr>

    @foreach ($medicos as $key => $medico)
    <tr>
        <td>{{ $medico->posto->posto }}</td>
        <td>{{ $medico->nome }}</td>
        <td>{{ $medico->situacao }}</td>
        <td>
            @can('admin')
                <a class="btn btn-white" href="{{ route('medicos.edit',$medico->id) }}"><img src="{{url('storage/icons/edit.png')}}" height="20"> Editar</a>
            @endcan
        </td>
    </tr>
    @endforeach
</table>


@endsection
