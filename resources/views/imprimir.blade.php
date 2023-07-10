@extends('layouts.login')

@section('content')

    <div class="row margin-bottom-10">
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <h2 class="title-caderneta">Ficha da Instrução Individual Básica</h2>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 row margin-bottom-10">
            <div class="row card-fo">
                <div class="col-12 row">
                    <h3 class="text-center">{{ $militar->getMilitar() }}</h3>
                    <div class="row">
                        <div class="col-5 text-left row">
                            <h4 class="">Fração: {{ $militar->pelotao->pelotao }} -
                                {{ $militar->pelotao->cmt_pelotao }}</h4>
                        </div>
                        <div class="col-4 text-left row">
                            <h4>Subunidade: {{ $militar->subunidade->nome }}</h4>
                        </div>
                        <div class="col-3 text-left row">
                            <h4>Situação: {{ $militar->situacao }}</h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-12 row margin-bottom-10">
            
            @if ($resultados_fiib->isNotEmpty())
                @php
                    $valor_chunk = 1;
                    if (count($resultados_fiib) > 4) {
                        $valor_chunk = ceil(count($resultados_fiib)/4);
                    }
                    $grupoResultados = $resultados_fiib->chunk($valor_chunk);
                @endphp                

                @foreach ($grupoResultados as $grupo)
                <div class="col-3">
                    <div class="row item-oii text-center fiib-thead">
                        <div class="col-12">OII</div>
                        <div class="col-5">Identificação</div>
                        <div class="col-7">
                            Padrão Mínimo
                        </div>
                    </div>

                    @foreach ($grupo as $key => $resultado)
                        <div class="row item-oii text-center">
                            <div class="col-5">{{ $resultado->objetivo_instrucao->getOII() }}</div>
                            <div class="col-7 text-center">
                                @if ($resultado->padrao_minimo_atingido == 1)
                                    <b class="color-green">
                                        <ion-icon name="checkmark-circle"></ion-icon>
                                    </b>
                                @else
                                    <b class="color-red">
                                        <ion-icon name="close-circle"></ion-icon>
                                    </b>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @endforeach
            @else
                <div class="row card-fo">
                    <div class="col-12 row">
                        <h4 class="col-12 text-center">
                            O militar não possui informações da FIIB
                        </h4>
                    </div>
                </div>
            @endif

        </div>

    </div>
@endsection
