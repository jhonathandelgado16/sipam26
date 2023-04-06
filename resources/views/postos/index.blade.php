@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
    <div class="row">
        <div class="pull-left col-8">
            <h2>Controle de Posto Graduação</h2>
        </div>
        <div class="row justify-content-end col-4">

        </div>
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <div class="pull-right col-8">
                    <a class="btn btn-white" href="{{ route('admins.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
                </div>
                <div class="row justify-content-end col-4">
                    @can('posto-create')
                        <a class="col-10 btn btn-primary" href="{{ route('postos.create') }}"> Adicionar Posto/Graduação</a>
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
        <th>Posto/Graduação</th>
        <th width="280px">Ações</th>
    </tr>

    @foreach ($postos as $key => $posto)
    <tr>
        <td>{{ $posto->posto }}</td>
        <td>
            @can('posto-edit')
                <a class="btn btn-white" href="{{ route('postos.edit',$posto->id) }}"><img src="{{url('storage/icons/edit.png')}}" height="20"> Editar</a>
            @endcan
        </td>
    </tr>
    @endforeach
</table>


@endsection
