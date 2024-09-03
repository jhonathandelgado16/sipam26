@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <div class="pull-left col-8">
                    <h2>Militares com Punições</h2>
                </div>
                <div class="col-lg-12 margin-tb">
                    <div class="row">
                        {{-- <div class="col-4">
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
                        @endcan --}}
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
            <th>Advertência</th>
            <th>Impedimento</th>
            <th>Repreensão</th>
            <th>Detenção</th>
            <th>Prisão</th>
            <th>Visualizar</th>
        </tr>

        @if ($militares->isNotEmpty())
            @foreach ($militares as $key => $militar)
                <tr>
                    <td>{{ $militar->getMilitar() }}</td>
                    <td>{{ $militar->getQuantidadeAdv() }}</td>
                    <td>{{ $militar->getQuantidadeImp() }}</td>
                    <td>{{ $militar->getQuantidadeRep() }}</td>
                    <td>{{ $militar->getQuantidadeDet() }}</td>
                    <td>{{ $militar->getQuantidadePrisao() }}</td>
                    <td>
                            <a class="btn btn-white" href="{{ route('punicoes.view', $militar->id) }}"><img
                                    src="{{ url('storage/icons/view.png') }}" height="20"> Visualizar</a>
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
