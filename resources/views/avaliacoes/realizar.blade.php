@extends('layouts.app')

@section('content')
    <div class="row margin-bottom-15">
        <div class="pull-right col-8">
            <a class="btn btn-white" href="{{ route('avaliacao.index') }}"><img src="{{ url('storage/icons/back.png') }}"
                    height="20"> Voltar</a>
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


    {!! Form::open(['route' => 'avaliacao.store', 'method' => 'POST']) !!}

    <input value="{{ $militar->id }}" type="number" class="d-none" name="militar_id">
    <div class="row justify-content-center">
        <h2 class="col-10 font-large">Regras para realizar a avaliação</h2>
        <div class="col-10 card-sipam">
            <table class="table">
                <thead>
                    <th>
                        Quantidade possível de nota atribuída
                        acima de 9,0 até 10,0 (Conceito E) nos
                        atributos básicos
                    </th>
                    <th>
                        Quantidade possível de nota atribuída
                        acima de 9,0 até 10,0 (Conceito E)
                        nos atributos funcionais
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            06 em um total de 08 (dos conteúdos
                            atitudinais básicos), ou seja, 75%
                        </td>
                        <td>
                            05 em um total de 06 (dos conteúdos
                            atitudinais funcionais), ou seja, 83,3%
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


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
        <div id="alert-basicos" class="col-10 card-alert-curso row" style="display: none">
            <b class="col-12 text-center font-x-large"><ion-icon name="warning"></ion-icon></b>
            <h3 class="font-medium text-center">Atenção na quantidade de notas máximas permitidas</h3>
            <br>
            <h3 class="font-medium text-center">São permitidas apenas 6 (seis) notas máximas (9 ou 10) para os atributos
                básicos</h3>
            <h3 class="font-medium text-center">Atualmente você possui <div class="font-large" id="qtd-basicos">XX</div>
                atributos com a nota máxima!</h3>

        </div>

        @foreach ($atributos_basicos as $atributo)
            <div class="col-5 margin-bottom-15 card-avaliacao">
                <div class="row justify-content-center">
                    <div class="atributo">
                        <h1 class="font-large text-center">
                            {{ $atributo->nome }}
                        </h1>
                    </div>
                    <div class="radio-avaliacao col-12 row justify-content-center">

                        <h2 class="font-x-small col-12 text-center">Por favor selecione abaixo, o conceito do militar nesse
                            atributo</h2>

                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_1" value="1">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_1">1</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_2" value="2">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_2">2</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_3" value="3">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_3">3</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_4" value="4">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_4">4</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_5" value="5">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_5">5</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_6" value="6">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_6">6</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_7" value="7">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_7">7</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_8" value="8">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_8">8</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_9" value="9">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_9">9</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check basicos" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_10" value="10">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_10">10</label>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <h1 class="col-10 title-sipam text-center font-large">Atributos Funcionais</h1>
        <div id="alert-funcionais" class="col-10 card-alert-curso row" style="display: none">
            <b class="col-12 text-center font-x-large"><ion-icon name="warning"></ion-icon></b>
            <h3 class="font-medium text-center">Atenção na quantidade de notas máximas permitidas</h3>
            <br>
            <h3 class="font-medium text-center">São permitidas apenas 5 (cinco) notas máximas (9 ou 10) para os atributos
                funcionais</h3>
            <h3 class="font-medium text-center">Atualmente você possui <div class="font-large" id="qtd-funcionais">XX
                </div>
                atributos com a nota máxima!</h3>

        </div>
        @foreach ($atributos_funcionais as $atributo)
            <div class="col-5 margin-bottom-15 card-avaliacao">
                <div class="row justify-content-center">
                    <div class="atributo">
                        <h1 class="font-large text-center">
                            {{ $atributo->nome }}
                        </h1>
                    </div>
                    <div class="radio-avaliacao col-12 row justify-content-center">

                        <h2 class="font-x-small col-12 text-center">Por favor selecione abaixo, o conceito do militar nesse
                            atributo</h2>

                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_1" value="1">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_1">1</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_2" value="2">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_2">2</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_3" value="3">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_3">3</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_4" value="4">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_4">4</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_5" value="5">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_5">5</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_6" value="6">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_6">6</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_7" value="7">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_7">7</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_8" value="8">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_8">8</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_9" value="9">
                            <label class="btn btn-outline-primary font-x-small" for="{{ $atributo->id }}_9">9</label>
                        </div>
                        <div class="col-1">
                            <input class="btn-check funcionais" type="radio" name="{{ $atributo->id }}"
                                id="{{ $atributo->id }}_10" value="10">
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
                A Nota final do {{ $militar->getMilitar() }} será
            </div>
            <div class="col-2 text-center bg-color-004aad">
                <h1 id="nota-final" class="font-color-fff">

                </h1>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center row justify-content-center">
        <button id="button-salvar" type="submit" class="col-3 btn btn-sipam text-large" style="display: none">Finalizar
            avaliação</button>
    </div>
    </div>
    {!! Form::close() !!}


    <script>
        $(document).ready(function() {
            $("input[type=radio]").on("change", function() {

                basicos = $(".basicos:checked");
                funcionais = $(".funcionais:checked");

                if (basicos.length == 8 && funcionais.length == 6) {

                    let nota_basicos = 0;
                    let nota_funcionais = 0;

                    let quantidade_notas_10_basicos = 0;
                    let quantidade_notas_10_funcionais = 0;

                    for (let i = 0; i < basicos.length; ++i) {
                        if (basicos[i].value > 8) {
                            quantidade_notas_10_basicos += 1;
                        }

                        nota_basicos = parseInt(nota_basicos) + parseInt(basicos[i].value);
                    }

                    for (let i = 0; i < funcionais.length; ++i) {
                        if (funcionais[i].value > 8) {
                            quantidade_notas_10_funcionais += 1;
                        }
                        nota_funcionais = parseInt(nota_funcionais) + parseInt(funcionais[i].value)
                    }

                    if (quantidade_notas_10_basicos > 6) {
                        $('#alert-basicos').show();
                        $('#button-salvar').hide();
                        $('#qtd-basicos').html(quantidade_notas_10_basicos);

                        if (quantidade_notas_10_funcionais > 5) {
                            $('#alert-funcionais').show();
                            $('#button-salvar').hide();
                            $('#qtd-funcionais').html(quantidade_notas_10_funcionais);
                        } else {
                            $('#alert-funcionais').hide();
                        }
                    } else {
                        if (quantidade_notas_10_funcionais > 5) {
                            $('#alert-funcionais').show();
                            $('#button-salvar').hide();
                            $('#qtd-funcionais').html(quantidade_notas_10_funcionais);
                            $('#alert-basicos').hide();
                        } else {
                            $('#button-salvar').show();
                            $('#alert-basicos').hide();
                            $('#alert-funcionais').hide();
                        }
                    }

                    let nota_final = (((nota_basicos / 8) + (nota_funcionais / 6)) / 2);

                    $('#nota-final').html(nota_final.toFixed(2));
                } else {

                    $('#button-salvar').hide();
                }


            });

        });
    </script>

@endsection
