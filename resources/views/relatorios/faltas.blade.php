@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <div class="pull-left col-8">
                    <h2>Relatórios sobre faltas</h2>
                </div>
                <div class="col-lg-12 margin-tb">
                    <div class="row">
                        @can('admin')
                            <div class="col-12">
                                <form action="{{ route('relatorios.faltas') }}" method="GET" class="row">
                                    <div class="row justify-content-center">
                                        <select id="filtro" name="filtro" class="form-select select-search col-9">
                                            @foreach ($filtros as $filtro)
                                                @if ($filtro_selecionado == $filtro['id'])
                                                    <option value="{{ $filtro['id'] }}" selected>
                                                        {{ $filtro['descricao'] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $filtro['id'] }}">
                                                        {{ $filtro['descricao'] }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-primary col-3">Procurar</button>
                                    </div>
                                </form>
                            </div>
                        @endcan
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

    <div class="row justify-content-center">
        @switch($filtro_selecionado)
            @case('curso reengajamento')
                <div class="col-3">
                    <div class="col-12 row card-sipam border-shadow">
                        <div class="">
                            <div class="row">
                                <h5 class="col-12 font-x-small text-center">
                                    militares que não possuem:
                                </h5>
                                <h5 class="col-12 text-center escolaridade-ficha color-red font-60">
                                    <b>{{ $qtd_militares_sem }}</b>
                                </h5>
                                <h5 class="col-12 text-center font-small color-red">
                                    {{ app(App\Models\Relatorios::class)->getPorcentagemMilitaresSemCursoReengajamento() }}% dos
                                    Militares
                                </h5>
                                <div
                                    style="width: {{ app(App\Models\Relatorios::class)->getPorcentagemMilitaresSemCursoReengajamento() }}%; 
                                background-color: red; height: 10px; margin:0; padding:0 !important;">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row card-sipam col-12">
                    <div
                        style="width: {{ app(App\Models\Relatorios::class)->getPorcentagemMilitaresSemCursoReengajamento() }}%; 
                                background-color: red; height: 10px; margin:0; padding:0 !important;">
                    </div>
                    <div
                        style="width: {{ app(App\Models\Relatorios::class)->getPorcentagemMilitaresComCursoReengajamento() }}%; 
                                background-color: green; height: 10px; padding:0 !important;">
                    </div>
                </div> --}}
                    <div class="col-12 row card-sipam border-shadow">
                        <div class="">
                            <div class="row justify-content-end">
                                <div
                                    style="width: {{ app(App\Models\Relatorios::class)->getPorcentagemMilitaresComCursoReengajamento() }}%; 
                                background-color: green; height: 10px; padding:0 !important;">
                                </div>

                                <h5 class="col-12 text-center font-small color-green">
                                    {{ app(App\Models\Relatorios::class)->getPorcentagemMilitaresComCursoReengajamento() }}% dos
                                    Militares
                                </h5>

                                <h5 class="col-12 text-center escolaridade-ficha color-green font-60">
                                    <b>{{ $qtd_militares_com }}</b>
                                </h5>

                                <h5 class="col-12 font-x-small text-center">
                                    militares que possuem:
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            @break

            @case('escolaridade')
                <div class="col-3">
                    <div class="col-12 row card-sipam border-shadow">
                        <div class="">
                            <div class="row">
                                <h5 class="col-12 font-x-small text-center">
                                    militares que não possuem:
                                </h5>
                                <h5 class="col-12 text-center escolaridade-ficha color-red font-60">
                                    <b>{{ $qtd_militares_sem }}</b>
                                </h5>
                                <h5 class="col-12 text-center font-small color-red">
                                    {{ app(App\Models\Relatorios::class)->getPorcentagemMilitaresSemEscolaridade() }}% dos
                                    Militares
                                </h5>
                                <div
                                    style="width: {{ app(App\Models\Relatorios::class)->getPorcentagemMilitaresSemEscolaridade() }}%; 
                                background-color: red; height: 10px; margin:0; padding:0 !important;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row card-sipam border-shadow">
                        <div class="">
                            <div class="row justify-content-end">
                                <div
                                    style="width: {{ app(App\Models\Relatorios::class)->getPorcentagemMilitaresComEscolaridade() }}%; 
                                background-color: green; height: 10px; padding:0 !important;">
                                </div>

                                <h5 class="col-12 text-center font-small color-green">
                                    {{ app(App\Models\Relatorios::class)->getPorcentagemMilitaresComEscolaridade() }}% dos
                                    Militares
                                </h5>

                                <h5 class="col-12 text-center escolaridade-ficha color-green font-60">
                                    <b>{{ $qtd_militares_com }}</b>
                                </h5>

                                <h5 class="col-12 font-x-small text-center">
                                    militares que possuem:
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            @break

            @case('taf')
                <div class="col-3">
                    <div class="col-12 row card-sipam border-shadow">
                        <div class="">
                            <div class="row">
                                <h5 class="col-12 font-x-small text-center">
                                    militares que não possuem:
                                </h5>
                                <h5 class="col-12 text-center escolaridade-ficha color-red font-60">
                                    <b>{{ $qtd_militares_sem }}</b>
                                </h5>
                                <h5 class="col-12 text-center font-small color-red">
                                    {{ app(App\Models\Relatorios::class)->getPorcentagemMilitaresSemTaf() }}% dos
                                    Militares
                                </h5>
                                <div
                                    style="width: {{ app(App\Models\Relatorios::class)->getPorcentagemMilitaresSemTaf() }}%; 
                                background-color: red; height: 10px; margin:0; padding:0 !important;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 row card-sipam border-shadow">
                        <div class="">
                            <div class="row justify-content-end">
                                <div
                                    style="width: {{ app(App\Models\Relatorios::class)->getPorcentagemMilitaresComTaf() }}%; 
                                background-color: green; height: 10px; padding:0 !important;">
                                </div>

                                <h5 class="col-12 text-center font-small color-green">
                                    {{ app(App\Models\Relatorios::class)->getPorcentagemMilitaresComTaf() }}% dos
                                    Militares
                                </h5>

                                <h5 class="col-12 text-center escolaridade-ficha color-green font-60">
                                    <b>{{ $qtd_militares_com }}</b>
                                </h5>

                                <h5 class="col-12 font-x-small text-center">
                                    militares que possuem:
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            @break

            @default
        @endswitch

        <div class="col-8 card-sipam border-shadow">

            <div id="titulo-sem" class="title-sipam font-large text-center">

            </div>
            <div class="row margin-bottom-15 scroll-y-400">
                @foreach ($militares_sem as $militar)
                    <div class="col-4">
                        {{ $militar->getMilitar() }}
                    </div>
                @endforeach
            </div>

            <div id="titulo-com" class="title-sipam font-large text-center">

            </div>
            <div class="row margin-bottom-15 scroll-y-400">
                @foreach ($militares_com as $militar)
                    <div class="col-4">
                        {{ $militar->getMilitar() }}
                    </div>
                @endforeach
            </div>

        </div>

    </div>
    </div>

    <script>
        $(document).ready(function() {
            switch($("#filtro :selected").val()){
                case 'curso reengajamento':
                    $('#titulo-com').html('<b>Militares com curso para reengajamento</b>');
                    $('#titulo-sem').html('<b>Militares sem curso para reengajamento</b>');
                    break;
                case 'escolaridade':
                    $('#titulo-com').html('<b>Militares com escolaridade cadastrada</b>');
                    $('#titulo-sem').html('<b>Militares sem escolaridade cadastrada</b>');
                    break;
                case 'taf':
                    $('#titulo-com').html('<b>Militares que possuem TAF</b>');
                    $('#titulo-sem').html('<b>Militares que não possuem TAF</b>');
                    break;
            }
            
        });
    </script>
@endsection
