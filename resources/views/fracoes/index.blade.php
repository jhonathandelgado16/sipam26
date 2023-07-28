@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
    <div class="row">
        <div class="pull-left col-8">
            <h2>Frações</h2>
        </div>
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <div class="pull-right col-8">
                    <a class="btn btn-white" href="{{ route('admins.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
                </div>
                <div class="row justify-content-end col-4">
                    @can('admin')
                        <a class="col-7 btn btn-primary" href="{{ route('fracoes.create') }}">Adicionar Fração</a>
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
        <th>Fração</th>
        <th>Status</th>
        <th>Militar Responsável</th>
        <th width="280px">Ações</th>
    </tr>

    @foreach ($fracoes as $fracao)
    <tr>
        <td>{{ $fracao->nome }}</td>
        <td>
            @if ($fracao->status == 1)
                Ativo
            @else
                Inativo
            @endif
        </td>
        <td>
            {{ $fracao->getMilitarResponsavel() }}
        </td>
        <td>
            @can('admin')
                <a class="btn btn-white" href="{{ route('fracoes.edit',$fracao->id) }}"><img src="{{url('storage/icons/edit.png')}}" height="20"> Editar</a>
            @endcan
        </td>
    </tr>
    @endforeach
</table>

@endsection
