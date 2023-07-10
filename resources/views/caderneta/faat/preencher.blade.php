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
                <h2 class="title-caderneta">Preencher Ficha de Avaliação de Atributos</h2>
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
        {!! Form::open(['route' => ['faat.realizar', $militar->id], 'method' => 'POST']) !!}

        <div class="row col-12">
            <div class="row item-oii text-center fiib-thead font-medium">
                <div class="col-6">Identificação</div>
                <div class="col-6">Padrão Evidenciado</div>
            </div>

            @for ($i = 0; $i < count($atributos); $i++)
                
            <div class="row item-oii text-center justify-content-center font-small">
                <div class="col-6">{{$atributos[$i][1]}}</div>
                <div class="col-6 row">
                    <div class="col row">
                        <input type="radio" value="1" class="btn-check" name="{{$atributos[$i][0]}}"
                            id="option1-{{$atributos[$i][0]}}" autocomplete="off" checked>
                        <label class="btn radio-check font-small" for="option1-{{$atributos[$i][0]}}">Sim</label>
                    </div>
                    <div class="col row">
                        <input type="radio" value="0" class="btn-check col" name="{{$atributos[$i][0]}}"
                            id="option0-{{$atributos[$i][0]}}" autocomplete="off">
                        <label class="btn radio-check font-small" for="option0-{{$atributos[$i][0]}}">Não</label>
                    </div>
                    <div class="col row">
                        <input type="radio" value="2" class="btn-check col" name="{{$atributos[$i][0]}}"
                            id="option2-{{$atributos[$i][0]}}" autocomplete="off">
                        <label class="btn radio-check font-small" for="option2-{{$atributos[$i][0]}}">Não Observado</label>
                    </div>
                </div>
            </div>

            @endfor
        </div>

        <div class="row col-12">
            <div class="row item-oii text-center fiib-thead font-medium">
                <div class="col-12">Apreciação Final do Período</div>
            </div>

            <div class="row item-oii text-center justify-content-center font-small">
                <div class="col-6">PODE SER MATRICULADO NO CURSO DE CABO?</div>
                <div class="col-6 row">
                    <div class="col row">
                        <input type="radio" value="1" class="btn-check" name="matricula_cfc"
                            id="option1-matricula" autocomplete="off" checked>
                        <label class="btn radio-check font-small" for="option1-matricula">Sim</label>
                    </div>
                    <div class="col row">
                        <input type="radio" value="0" class="btn-check col" name="matricula_cfc"
                            id="option0-matricula" autocomplete="off" checked>
                        <label class="btn radio-check font-small" for="option0-matricula">Não</label>
                    </div>
                </div>
            </div>

            <div class="row item-oii text-center justify-content-center font-small">
                <div class="col-6">FOI PUNIDO DURANTE A FASE?</div>
                <div class="col-6 row">
                    <div class="col row">
                        <input type="radio" value="1" class="btn-check" name="punicao_fase"
                            id="option1-punicao" autocomplete="off">
                        <label class="btn radio-check font-small" for="option1-punicao">Sim</label>
                    </div>
                    <div class="col row">
                        <input type="radio" value="0" class="btn-check col" name="punicao_fase"
                            id="option0-punicao" autocomplete="off" checked>
                        <label class="btn radio-check font-small" for="option0-punicao">Não</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row col-12">
            <div class="row item-oii text-center fiib-thead font-medium">
                <div class="col-12">Avaliação Global Subjetiva</div>
            </div>

            <div class="row item-oii text-center justify-content-center font-small">
                <div class="col-12 row">
                    <div class="col row">
                        <input type="radio" value="MB" class="btn-check" name="avaliacao_global"
                            id="option-mb-avaliacao" autocomplete="off">
                        <label class="btn radio-check font-small" for="option-mb-avaliacao">MUITO BOM</label>
                    </div>
                    <div class="col row">
                        <input type="radio" value="B" class="btn-check col" name="avaliacao_global"
                            id="option-b-avaliacao" autocomplete="off" checked>
                        <label class="btn radio-check font-small" for="option-b-avaliacao">BOM</label>
                    </div>
                    <div class="col row">
                        <input type="radio" value="R" class="btn-check col" name="avaliacao_global"
                            id="option-r-avaliacao" autocomplete="off">
                        <label class="btn radio-check font-small" for="option-r-avaliacao">REGULAR</label>
                    </div>
                    <div class="col row">
                        <input type="radio" value="I" class="btn-check col" name="avaliacao_global"
                            id="option-i-avaliacao" autocomplete="off">
                        <label class="btn radio-check font-small" for="option-i-avaliacao">INSUFICIENTE</label>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-success">Concluir</button>
    </div>
    </div>
    {!! Form::close() !!}

    </div>
@endsection
