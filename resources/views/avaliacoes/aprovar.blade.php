@extends('layouts.app')

@section('content')
    <div class="row margin-bottom-15">
        <div class="pull-right col-8">
            <a class="btn btn-white" href="{{ route('avaliacao.index') }}"><img
                    src="{{ url('storage/icons/back.png') }}" height="20"> Voltar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left title-sipam text-center">
                <h2 class="font-large">Realizar Avaliação de Conceito</h2>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Erro inesperado!</strong> Entre em contato com a Assessoria de Gestão para notificar o erro
            encontrado.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-12 row margin-bottom-10 justify-content-center">
        <div class="row card-sipam">
            <div class="col-2 row justify-content-center">
                <img class="col-md-10" src="{{ url('storage/perfil.png') }}">
            </div>
            <div class="col-10 row">
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
                    <div class="col-6 text-left row">
                        <h4 class="">Nome Completo: {{ $militar->nome }}</h4>
                    </div>
                    <div class="col-3 text-left row">
                        <h4 class="col">CPF: {{ $militar->cpf }}</h4>
                    </div>
                    <div class="col-3 text-left row">
                        <h4 class="col">IDT: {{ $militar->idt_militar }}</h4>
                    </div>
                    <div class="col-4 text-left row">
                        <h4 class="col">Contato: {{ $militar->contato }}</h4>
                    </div>
                    <div class="col-8 text-left row">
                        <h4 class="col-12">Endereço: {{ $militar->endereco }}</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>


    {!! Form::open(['route' => 'avaliacao.aprovar_update', 'method' => 'PATCH']) !!}

    <input value="{{ $militar->id }}" type="number" class="d-none" name="militar_id">
   
    <div class="col-12 justify-content-center row d-none">
        <div class="col-6">
            <strong>Selecione a fase da Avaliação</strong>
            <select class="form-select" name="fase" id="" readonly>
                <option value="formativa">Formativa</option>
                <option value="somativa" selected>Somativa</option>
            </select>

        </div>
    </div>

    <div class="row justify-content-center">
        <h1 class="col-10 title-sipam text-center font-large">Atributos Básicos</h1>
        @foreach ($atributos_basicos as $atributo)
            <div class="col-5 margin-bottom-15 card-avaliacao">
                <div class="row justify-content-center">
                    <div class="atributo">
                        <h1 class="font-large text-center">
                            {{ $atributo->atributo->nome }}
                        </h1>
                    </div>
                    <div class="radio-avaliacao col-12 row justify-content-center">

                        <h2 class="font-x-small col-12 text-center">Por favor selecione abaixo, o conceito do militar nesse
                            atributo</h2>

                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_1" value="1" @if($atributo->nota == '1') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_1">1</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_2" value="2" @if($atributo->nota == '2') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_2">2</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_3" value="3" @if($atributo->nota == '3') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_3">3</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_4" value="4" @if($atributo->nota == '4') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_4">4</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_5" value="5" @if($atributo->nota == '5') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_5">5</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_6" value="6" @if($atributo->nota == '6') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_6">6</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_7" value="7" @if($atributo->nota == '7') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_7">7</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_8" value="8" @if($atributo->nota == '8') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_8">8</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_9" value="9" @if($atributo->nota == '9') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_9">9</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_10" value="10" @if($atributo->nota == '10') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_10">10</label>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <h1 class="col-10 title-sipam text-center font-large">Atributos Funcionais</h1>
        @foreach ($atributos_funcionais as $atributo)
            <div class="col-5 margin-bottom-15 card-avaliacao">
                <div class="row justify-content-center">
                    <div class="atributo">
                        <h1 class="font-large text-center">
                            {{ $atributo->atributo->nome }}
                        </h1>
                    </div>
                    <div class="radio-avaliacao col-12 row justify-content-center">

                        <h2 class="font-x-small col-12 text-center">Por favor selecione abaixo, o conceito do militar nesse
                            atributo</h2>

                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_1" value="1" @if($atributo->nota == '1') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_1">1</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_2" value="2" @if($atributo->nota == '2') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_2">2</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_3" value="3" @if($atributo->nota == '3') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_3">3</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_4" value="4" @if($atributo->nota == '4') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_4">4</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_5" value="5" @if($atributo->nota == '5') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_5">5</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_6" value="6" @if($atributo->nota == '6') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_6">6</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_7" value="7" @if($atributo->nota == '7') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_7">7</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_8" value="8" @if($atributo->nota == '8') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_8">8</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_9" value="9" @if($atributo->nota == '9') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_9">9</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_10" value="10" @if($atributo->nota == '10') checked @endif disabled>
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_10">10</label>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <div class="row justify-content-center margin-bottom-10">
        <div class="col-10 card-sipam row justify-content-center">
            <div class="col-12 text-center font-medium">
                A Nota final do {{$militar->getMilitar()}} será
            </div>
            <div class="col-2 text-center bg-color-004aad">
                <h1 id="nota-final" class="font-color-fff">
                    {{$avalicao_militar->nota_final}}
                </h1>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center row justify-content-center">
        <button id="button-salvar" type="submit" class="col-3 btn btn-sipam text-large">Aprovar avaliação</button>
    </div>
    </div>
    {!! Form::close() !!}

@endsection
