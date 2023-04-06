@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
    <div class="row">
        <div class="pull-left col-8">
            <h2>Controle de Pelotões</h2>
        </div>
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <div class="pull-right col-8">
                    <a class="btn btn-white" href="{{ route('admins.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
                </div>
                <div class="row justify-content-end col-4">
                    @can('pelotao-create')
                        <a class="col-7 btn btn-primary" href="{{ route('pelotoes.create') }}"> Adicionar Pelotão</a>
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
        <th>Pelotão</th>
        <th>Cmt Pelotão</th>
        <th>Subunidade</th>
        <th width="280px">Ações</th>
    </tr>

    @foreach ($pelotoes as $key => $pelotao)
    <tr>
        <td>{{ $pelotao->pelotao }}</td>
        <td>{{ $pelotao->cmt_pelotao }}</td>
        <td>{{ $pelotao->subunidade->nome }}</td>
        <td>
            @can('pelotao-edit')
                <a class="btn btn-white" href="{{ route('pelotoes.edit',$pelotao->id) }}"><img src="{{url('storage/icons/edit.png')}}" height="20"> Editar</a>
            @endcan
        </td>
    </tr>
    @endforeach
</table>

@endsection
