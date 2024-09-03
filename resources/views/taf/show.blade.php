@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb margin-bottom-15">
            <div class="row">

                <div class="col-lg-12 margin-tb margin-bottom-15">
                    <div class="row">
                        <div class="pull-right col-8">
                            <a class="btn btn-white" href="{{ route('taf.index') }}"><img
                                    src="{{ url('storage/icons/back.png') }}" height="20"> Voltar</a>
                        </div>
                    </div>
                </div>

                <div class="title-sipam col-12 row">
                    <h2 class="font-x-large col-9">Resultados do {{ $taf_numero->numero }}</h2>
                    <a class="col-3 btn btn-sipam" href="{{ route('taf.create') }}"><ion-icon name="add-circle"></ion-icon>
                        Inserir TAF Realizado</a>
                </div>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="col-12 row justify-content-center card-sipam">
        <div class="col-12">
            @foreach ($publicacoes_taf as $publicacao_taf)
                @foreach (app(App\Models\TafMencao::class)->getMencoesDoTaf( $taf_numero->id, $publicacao_taf->id) as $mencao)
                    <div class="row margin-bottom-10">
                        <h2 class="subtitle-sipam font-large">Obtiveram a menção {{ $mencao->mencao }}, publicado no
                            {{ $publicacao_taf->getPublicacao() }}</h2>

                        @foreach (app(App\Models\Taf::class)->getTafPorPublicacoesMencao( $publicacao_taf->id, $mencao->id, $subunidade_id) as $taf)
                            <div class="col-12">
                                <h2 class="col-12 font-small">{{ $taf->militar->getMIlitar() }}</h3>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
