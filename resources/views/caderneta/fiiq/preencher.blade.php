@extends('layouts.app')

@section('content')
    <div class="row margin-bottom-15">
        <div class="pull-right col-8">
            <a class="btn btn-white" href="{{ route('caderneta.ficha', $militar->id) }}"><img
                    src="{{ url('storage/icons/back.png') }}" height="20"> Voltar</a>
        </div>
    </div>

    <div class="row margin-bottom-10">
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <h2 class="title-caderneta">Preencher Ficha da Instrução Individual de Qualificação</h2>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 row margin-bottom-10">
            <div class="row card-fo justify-content-center">
                <div class="col-2 row justify-content-center">
                    <img class="col-md-6" src="{{ url('storage/caveira.png') }}">
                </div>
                <div class="col-10 row">
                    <h3 class="text-center">{{ $militar->getMilitar() }}</h3>
                    <div class="row">
                        <h4 class="col text-center">Fração: {{ $militar->pelotao->pelotao }}</h4>
                        <h4 class="col text-center">Subunidade: {{ $militar->subunidade->nome }}</h4>
                    </div>
                </div>

            </div>
        </div>
        {!! Form::open(['route' => ['fiiq.realizar', $militar->id], 'method' => 'POST']) !!}

        <div class="row col-12">
            @php
                $valor_chunk = 1;
                if (count($objetivos_dentro_da_fiiq) > 2) {
                    $valor_chunk = ceil(count($objetivos_dentro_da_fiiq) / 2);
                }
                $grupoObjetivos = $objetivos_dentro_da_fiiq->chunk($valor_chunk);
                $counter = 0;
            @endphp

            @foreach ($grupoObjetivos as $grupo)
                <div class="col-6">
                    <div class="row item-oii text-center fiib-thead">
                        <div class="col-9">Identificação</div>
                        <div class="col-3">
                            Padrão Mínimo
                        </div>
                    </div>

                    @foreach ($grupo as $key => $objetivo_instrucao)
                        <div class="row item-oii text-center">
                            <input class="d-none" type="number" name="informacoes[{{ $counter }}][0]"
                                value="{{ $objetivo_instrucao->id }}">
                            <div class="col-9  font-small">{{ $objetivo_instrucao->getOII() }}</div>
                            <div class="col-3 row">
                                <input type="radio" value="2" class="d-none"
                                        name="informacoes[{{ $counter }}][1]"
                                        checked>
                                <div class="col-6">
                                    <input type="radio" value="1" class="btn-check"
                                        name="informacoes[{{ $counter }}][1]"
                                        id="option1-{{ $objetivo_instrucao->id }}" autocomplete="off">
                                    <label class="btn radio-check" for="option1-{{ $objetivo_instrucao->id }}">Sim</label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" value="0" class="btn-check"
                                        name="informacoes[{{ $counter }}][1]"
                                        id="option2-{{ $objetivo_instrucao->id }}" autocomplete="off">
                                    <label class="btn radio-check" for="option2-{{ $objetivo_instrucao->id }}">Não</label>
                                </div>
                            </div>
                        </div>
                        @php
                            $counter++;
                        @endphp
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-success">Adicionar</button>
    </div>
    </div>
    {!! Form::close() !!}


    </div>
@endsection
