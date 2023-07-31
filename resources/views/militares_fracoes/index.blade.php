@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
    <div class="row">
        <div class="pull-left col-8">
            <h2>Gerenciar Militares dentro das Frações</h2>
        </div>
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <div class="pull-right col-8">
                    <a class="btn btn-white" href="{{ route('admins.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
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
        <th>Fração</th>
        <th>Militar Responsável</th>
        <th>Qtd de Militares</th>
        <th width="280px">Ações</th>
    </tr>

    @foreach ($fracoes as $fracao)
    <tr>
        <td>{{ $fracao->nome }}</td>
        <td>
            {{ $fracao->getMilitarResponsavel() }}
        </td>
        <td>
            {{ $fracao->getQtdMilitares() }} militar(es)
        </td>
        <td>
            @can('admin')
                <a class="btn btn-white" href="{{ route('militares_fracoes.relacionar', $fracao->id) }}"><img src="{{url('storage/icons/add-militar.png')}}" height="20"> Adicionar militares</a>
            @endcan
        </td>
    </tr>
    @endforeach
</table>

@endsection
