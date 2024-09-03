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
                        <div class="col-4">
                            <form action="{{ route('militares.procurar') }}" method="GET" class="form-search col-12 row">
                                <input type="text" name="search" placeholder="Pesquise por nome ou número"
                                    value="{{ $search }}" class="col-8 form-control" />
                                <button type="submit" class="btn btn-primary col-4">Procurar</button>
                            </form>
                        </div>
                        @can('admin')
                            <div class="col-4">
                                <form action="{{ route('militares.procurar_subunidade') }}" method="GET" class="row">
                                    <div class="row">
                                        <select name="subunidade_id" class="form-select select-search col-8">
                                            <option value="">Pesquisa por SU</option>
                                            @foreach ($subunidades as $key => $subunidade)
                                                @if ($search_su == $subunidade->id)
                                                    <option value="{{ $subunidade->id }}" selected>
                                                        {{ $subunidade->nome }}
                                                    </option>
                                                @else
                                                    <option value="{{ $subunidade->id }}">
                                                        {{ $subunidade->nome }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-primary col-4">Procurar</button>
                                    </div>
                                </form>
                            </div>
                        @endcan
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

    <table class="table text-center card-sipam">
        <tr>
            <th>Militar</th>
            <th width="800px">Ações</th>
        </tr>

        @if ($militares->isNotEmpty())
            @foreach ($militares as $key => $militar)
                <tr>
                    <td>{{ $militar->getMilitar() }}</td>
                    <td>
                        @can('militar-edit')
                            <a class="btn btn-white" href="{{ route('militares.edit', $militar->id) }}"><img
                                    src="{{ url('storage/icons/edit.png') }}" height="20"> Editar</a>
                            <a class="btn btn-white" href="{{ route('ficha_sipam.index', $militar->id) }}"><img
                                    src="{{ url('storage/icons/SIPAM26.png') }}" height="20"> Ficha SIPAM</a>
                            <a class="btn btn-red" href="{{ route('ficha_acompanhamentos.index', $militar->id) }}"><ion-icon
                                    name="people"></ion-icon> Ficha de Acompanhamento</a>
                            <a class="btn btn-white" target="_blank" href="{{ route('desmobilizacao.curriculo', $militar->id) }}"><ion-icon
                                    name="newspaper"></ion-icon> Curriculo</a>
                        @endcan
                        @can('militar-caderneta')
                            <a class="btn btn-green" href="{{ route('caderneta.ficha', $militar->id) }}"><img
                                    src="{{ url('storage/icons/caderneta.png') }}" height="20"> Caderneta</a>
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
