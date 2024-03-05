@extends('layouts.app')

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-3">
            <a class="btn btn-primary font-large" href="{{ route('ranking.atualizar') }}"><ion-icon
                    name="reload-circle"></ion-icon> Atualizar ranking</a>
        </div>
        <div class="col-9">
        <form action="{{ route('ranking.index') }}" method="GET" class="row">
            <div class="col-5 offset-1">
                <strong>Arma/QM:</strong>
                <select name="qualificacao_militar_id" class="form-select">
                    <option value="todos" @if ($option_qm == 'todos') selected @endif>Todas</option>
                    @foreach ($qms as $qm)
                        <option value="{{ $qm->id }}" @if ($option_qm == $qm->id) selected @endif>
                            {{ $qm->qualificacao . ' - ' . $qm->descricao }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-6">
                <div class="row">
                    <strong>Selecione o Posto/Graduação</strong>
                    <select name="posto" class="form-select select-search col-8">
                        <option value="todos" @if ($option == 'todos') selected @endif>Todos</option>
                        <option value="oficiais" @if ($option == 'oficiais') selected @endif>Oficiais</option>
                        <option value="sargentos" @if ($option == 'sargentos') selected @endif>Sargentos</option>
                        <option value="cabos" @if ($option == 'cabos') selected @endif>Cabos</option>
                        <option value="soldados-ep" @if ($option == 'soldados-ep') selected @endif>Soldados EP</option>
                        <option value="soldados-ev" @if ($option == 'soldados-ev') selected @endif>Soldados EV</option>
                    </select>
                    <button type="submit" class="btn btn-primary col-4">Filtrar</button>
                </div>
            </div>
        </form>
    </div>
    </div>

    <table class="table text-center card-sipam title-sipam font-small">
        <tr>
            <th class="col-1">Ranking</th>
            <th class="col-1">Militar</th>
            <th class="col-1">QM</th>
            <th class="col-1">Possui Curso?</th>
            <th class="col-1">Ultimo TAF</th>
            <th class="col-1">Conhecimento</th>
            <th class="col-1">Habilidade</th>
            <th class="col-1">Atitude</th>
            <th class="col-1">Possui Demérito?</th>
            <th class="col-1">Nota Final</th>
            <th class="col-2">Ficha</th>
        </tr>
    </table>
    <div class="height-100vh">
        <table class="table text-center card-sipam">
            <tbody>
                @if ($militares->isNotEmpty())
                    @php
                        $contagem = 1;
                    @endphp
                    @foreach ($militares as $militar)
                        <tr>
                            <td class="col-1">{{ $contagem }}</td>
                            <td class="col-1">{{ $militar->militar->getMilitar() }}</td>
                            <td class="col-1">{{ $militar->militar->qualificacao_militar->qualificacao }}</td>
                            <td class="col-1">
                                @if ($militar->militar->possuiCursoReengajamento())
                                    <div class="color-green font-large"><ion-icon name="checkmark-circle"></ion-icon></div>
                                @else
                                    <div class="color-red font-large"><ion-icon name="close-circle"></ion-icon></div>
                                @endif
                            </td>
                            <td class="col-1">{{ $militar->militar->getMaiorMencaoTaf() }}</td>
                            <td class="col-1">{{ $militar->nota_conhecimento }}</td>
                            <td class="col-1">{{ $militar->nota_habilidade }}</td>
                            <td class="col-1">{{ $militar->nota_atitude }}</td>
                            <td class="col-1">
                                @if ($militar->militar->possuiDemerito())
                                    <div class="color-red font-large"><ion-icon name="arrow-down-circle-sharp"></ion-icon></div>
                                @endif
                            </td>
                            <td class="col-1">{{ $militar->nota_final }}</td>
                            <td class="col-2"><a class="btn btn-white" target="_blank"
                                    href="{{ route('ficha_sipam.index', $militar->militar->id) }}"><img
                                        src="{{ url('storage/icons/SIPAM26.png') }}" height="20"> Ficha SIPAM</a></td>

                        </tr>
                        @php
                            $contagem++;
                        @endphp
                    @endforeach
                @else
                    <tr>
                        <td colspan="99">Não encontramos resultados para essa pesquisa</td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>


@endsection
