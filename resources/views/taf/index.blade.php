@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb margin-bottom-15">
            <div class="row">

                <div class="title-sipam col-12 row">
                    <h2 class="font-x-large col-9">Testes de Aptidão Física realizados</h2>
                    <a class="col-3 btn btn-sipam" href="{{ route('taf.create') }}"><ion-icon name="add-circle"></ion-icon>
                        Inserir TAF realizado</a>
                </div>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="col-12 row justify-content-center">
        @if (!$tafs_realizados->isEmpty())
            <div class="col-8">
                @foreach ($tafs_realizados as $taf_realizado)
                    <div class="row card-taf-realizado margin-bottom-10">
                        <div class="col-12 text-left">
                            <div class="row">
                                <h3 class="col-9">Resultados do {{ $taf_realizado->numero }}</h3>
                                <a class="col-3 btn btn-sipam font-small" href="{{ route('taf.show', $taf_realizado->id) }}"><ion-icon
                                        name="search-circle"></ion-icon> Visualizar menções</a>
                            </div>
                        </div>
                        <div class="col-12 card-mencoes">
                            <div class="row">
                                <div class="col-12 text-center">Quantidade de menções obtidas</div>
                                @foreach ($mencoes as $mencao)
                                    <div class="col text-center">
                                        <b>{{ $mencao->mencao }}:</b> {{ $taf_realizado->getQtdMencoes($mencao->mencao) }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
        <div class="col-12 text-center card-sipam">
            Não encontrou nenhum TAF cadastrado? Cadastre o TAF no sistema clicando no botão abaixo <ion-icon name="happy"></ion-icon> <br> 
            <a class="col-3 btn btn-primary" href="{{ route('taf.create') }}"><ion-icon name="add-circle"></ion-icon>
                Inserir TAF realizado</a>
        </div>
        @endif

    </div>
@endsection
