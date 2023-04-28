@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
    <div class="row">
        <div class="pull-left col-8">
            <h2>Controle de Militares</h2>
        </div>
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <div class="pull-right col-8">
                    <form action="{{ route('militares.procurar') }}" method="GET" class="form-search col-10 row">
                        <input type="text" name="search" placeholder="Pesquise por nome ou número" value="{{$search}}" class="col-8 form-control"/>
                        <button type="submit" class="btn btn-primary col-2">Procurar</button>
                    </form>
                </div>
                <div class="row justify-content-end col-4">
                    @can('militar-create')
                        <a class="col-7 btn btn-primary" href="{{ route('militares.create') }}"> Cadastrar Militar</a>
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
        <th>P/G</th>
        <th>Número</th>
        <th>Nome de Guerra</th>
        <th width="280px">Ações</th>
    </tr>

    @if($militares->isNotEmpty())
    @foreach ($militares as $key => $militar)
    <tr>
        <td>{{ $militar->posto->posto }}</td>
        <td>{{ $militar->numero }}</td>
        <td>{{ $militar->nome_de_guerra }}</td>
        <td>
            @can('militar-edit')
                <a class="btn btn-white" href="{{ route('militares.edit', $militar->id) }}"><img src="{{url('storage/icons/edit.png')}}" height="20"> Editar</a>
            @endcan
            @can('militar-caderneta')
            @if ($militar->posto->posto == 'Sd Ev')
            <a class="btn btn-green" href="{{ route('caderneta.ficha' , $militar->id) }}"><img src="{{url('storage/icons/caderneta.png')}}" height="20"> Caderneta</a>
            @endif
            @endcan
        </td>
    </tr>
    @endforeach
    @else
        <tr>
            <td colspan="99">Não encontramos resultados para essa pesquisa</td>
        </tr>
    @endif
</table>


@endsection
