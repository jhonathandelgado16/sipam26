@extends('layouts.app')

@section('content')
    <div class="row margin-bottom-15">
        <div class="pull-right col-8">
            <a class="btn btn-white" href="{{ route('militares.index') }}"><img src="{{ url('storage/icons/back.png') }}"
                    height="20"> Voltar</a>
        </div>
    </div>

    <div class="row margin-bottom-10">
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <h2 class="title-sipam">Ficha de Parametrização</h2>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
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

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="col-12 row justify-content-center">
            <div class="col-12 row">
            <div class="title-sipam">
                <h2 class="text-center">Conhecimento</h2>
            </div>
            </div>
            <div class="col-6 row margin-bottom-5 justify-content-center no-margin">
                <div class="row subtitle-sipam">
                    <h2 class="col-11">Escolaridade</h2>
                    <a class=" col-1 btn btn-sipam" href="{{ route('ficha_sipam.escolaridade_index', $militar->id) }}"><ion-icon name="search-circle"></ion-icon></a>
                </div>

                <div class="row card-sipam">
                    <div class="col-12 row">
                        <h4 class="col-12 text-center">
                            O militar não possui nenhum fato observado
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-6 row margin-bottom-5 justify-content-center no-margin">
                <div class="row subtitle-sipam">
                    <h2 class="col-11">Cursos e Estágios</h2>
                    <a class=" col-1 btn btn-sipam" href="{{ route('fo.inserir', $militar->id) }}"><ion-icon name="search-circle"></ion-icon></a>
                </div>

                <div class="row card-sipam">
                    <div class="col-12 row">
                        <h4 class="col-12 text-center">
                            O militar não possui nenhum fato observado
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 row justify-content-center">
            <div class="col-12 row">
            <div class="title-sipam">
                <h2 class="text-center">Habilidade</h2>
            </div>
            </div>
            <div class="col-6 row margin-bottom-5 justify-content-center no-margin">
                <div class="row subtitle-sipam">
                    <h2 class="col-11">TAF</h2>
                    <a class=" col-1 btn btn-sipam" href="{{ route('fo.inserir', $militar->id) }}"><ion-icon name="search-circle"></ion-icon></a>
                </div>

                <div class="row card-sipam">
                    <div class="col-12 row">
                        <h4 class="col-12 text-center">
                            O militar não possui nenhum fato observado
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-6 row margin-bottom-5 justify-content-center no-margin">
                <div class="row subtitle-sipam">
                    <h2 class="col-11">Curso de Formação</h2>
                    <a class=" col-1 btn btn-sipam" href="{{ route('fo.inserir', $militar->id) }}"><ion-icon name="search-circle"></ion-icon></a>
                </div>

                <div class="row card-sipam">
                    <div class="col-12 row">
                        <h4 class="col-12 text-center">
                            O militar não possui nenhum fato observado
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-6 row margin-bottom-5 justify-content-center no-margin">
                <div class="row subtitle-sipam">
                    <h2 class="col-11">Destaques do Ano de Instrução</h2>
                    <a class=" col-1 btn btn-sipam" href="{{ route('fo.inserir', $militar->id) }}"><ion-icon name="search-circle"></ion-icon></a>
                </div>

                <div class="row card-sipam">
                    <div class="col-12 row">
                        <h4 class="col-12 text-center">
                            O militar não possui nenhum fato observado
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-6 row margin-bottom-5 justify-content-center no-margin">
                <div class="row subtitle-sipam">
                    <h2 class="col-11">Curso de Formação de Condutores</h2>
                    <a class=" col-1 btn btn-sipam" href="{{ route('fo.inserir', $militar->id) }}"><ion-icon name="search-circle"></ion-icon></a>
                </div>

                <div class="row card-sipam">
                    <div class="col-12 row">
                        <h4 class="col-12 text-center">
                            O militar não possui nenhum fato observado
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 row justify-content-center">
            <div class="col-12 row">
            <div class="title-sipam">
                <h2 class="text-center">Atitude</h2>
            </div>
            </div>
            <div class="col-6 row margin-bottom-5 justify-content-center no-margin">
                <div class="row subtitle-sipam">
                    <h2 class="col-11">Escolaridade</h2>
                    <a class=" col-1 btn btn-sipam" href="{{ route('fo.inserir', $militar->id) }}"><ion-icon name="search-circle"></ion-icon></a>
                </div>

                <div class="row card-sipam">
                    <div class="col-12 row">
                        <h4 class="col-12 text-center">
                            O militar não possui nenhum fato observado
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-6 row margin-bottom-5 justify-content-center no-margin">
                <div class="row subtitle-sipam">
                    <h2 class="col-11">Cursos e Estágios</h2>
                    <a class=" col-1 btn btn-sipam" href="{{ route('fo.inserir', $militar->id) }}"><ion-icon name="search-circle"></ion-icon></a>
                </div>

                <div class="row card-sipam">
                    <div class="col-12 row">
                        <h4 class="col-12 text-center">
                            O militar não possui nenhum fato observado
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
