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
                <div class="row col-12">
                    <div class="col-3">
                        <h2 class="title-sipam font-small text-center">Pontos Conhecimento </h2> 
                        <h2 class="col-12 text-center font-color-004aad">{{$militar->getPontosConhecimento()}}<ion-icon
                            name="arrow-up-circle-sharp"></ion-icon></h2>
                    </div>
                    <div class="col-3">
                        <h2 class="title-sipam font-small text-center">Pontos Habilidade </h2> 
                        <h2 class="col-12 text-center font-color-004aad">{{$militar->getPontosHabilidade()}}<ion-icon
                            name="arrow-up-circle-sharp"></ion-icon></h2>
                    </div>
                    <div class="col-3">
                        <h2 class="title-sipam font-small text-center">Pontos Atitude </h2> 
                        <h2 class="col-12 text-center font-color-004aad">{{$militar->getPontosAtitude()}}<ion-icon
                            name="arrow-up-circle-sharp"></ion-icon></h2>
                    </div>
                    <div class="col-3 bg-color-004aad">
                        <h2 class="subtitle-sipam font-small text-center">Conceito Final</h2> 
                        <h2 class="col-12 text-center font-color-fff">{{$militar->getPontosMilitar()}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 row margin-bottom-10 justify-content-center">
            @if (!$cursos->isEmpty())
                <div class="row card-success-curso justify-content-center text-center">
                    <h4><ion-icon name="checkmark-circle"></ion-icon> Este militar já possui o curso necessário para o
                        reengajamento! </h4>
                </div>
            @else
                <div class="row card-alert-curso justify-content-center text-center">
                    <h4><ion-icon name="warning"></ion-icon> Este militar ainda não possui o curso necessário para o
                        reengajamento! </h4>
                </div>
            @endif
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="col-12 row justify-content-center margin-bottom-5 card-sipam">
            <div class="col-12 row title-sipam">
                <h2 class="text-center font-large">Conhecimento</h2>
            </div>
            <div class="col-6 margin-bottom-5 justify-content-center no-margin">
                <div class="row justify-content-center">
                    <div class="row subtitle-sipam">
                        <h2 class="col-11">Escolaridade</h2>
                        <a class=" col-1 btn btn-sipam"
                            href="{{ route('ficha_sipam.escolaridade_index', $militar->id) }}"><ion-icon
                                name="search-circle"></ion-icon></a>
                    </div>

                    <div class="row card-sipam border-shadow">
                        @if ($escolaridade != null)
                            <div class="col-12 row ">
                                <h5 class="col-12 text-center escolaridade-ficha">
                                    {{ $escolaridade->nome }}
                                </h5>
                                <h5 class="col-12 text-center escolaridade">
                                    {{ $escolaridade->instituicao_ensino }}
                                </h5>
                                <h5 class="text-end escolaridade font-color-004aad">
                                    {{ $escolaridade->pontos }} <ion-icon name="arrow-up-circle-sharp"></ion-icon>
                                </h5>
                            </div>
                        @else
                            <div class="col-12 row">
                                <h4 class="col-12 text-center">
                                    O militar não possui nenhuma escolaridade cadastrada
                                </h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-6 margin-bottom-5 justify-content-center no-margin">
                <div class="row justify-content-center">

                    <div class="row subtitle-sipam">
                        <h2 class="col-11">Cursos e Estágios</h2>
                        <a class=" col-1 btn btn-sipam"
                            href="{{ route('ficha_sipam.curso_index', $militar->id) }}"><ion-icon
                                name="search-circle"></ion-icon></a>
                    </div>
                    @if (!$cursos->isEmpty())
                        @foreach ($cursos as $curso)
                            <div class="col-12 row card-cursos border-shadow">
                                <div class="col-2 text-center">
                                    <h5 class="escolaridade-ficha font-color-004aad"><ion-icon name="school"></ion-icon>
                                    </h5>
                                    <h5 class="font-small font-color-004aad">{{ $curso->getPontuacaoCurso() }} <ion-icon
                                            name="arrow-up-circle-sharp"></ion-icon></h5>
                                </div>
                                <p class="col-10 text-center">
                                    Curso: {{ $curso->curso->nome }} <br>
                                    Instituição de Ensino: {{ $curso->curso->instituicao_ensino }} <br>
                                    Horas: {{ $curso->curso->horas }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <div class="row card-sipam">
                            <div class="col-12 row">
                                <h4 class="col-12 text-center">
                                    O militar não possui nenhum curso pontuando, pontuam os cursos realizados em
                                    {{ date('Y') }} e os cursos aprovados pelo operador do SIPAM
                                </h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 row justify-content-center card-sipam">
            <div class="col-12 row title-sipam">
                <h2 class="text-center font-large">Habilidade</h2>
            </div>
            <div class="col-4 margin-bottom-5 justify-content-center no-margin">
                <div class="row justify-content-center">
                    <div class="row subtitle-sipam">
                        <h2 class="col-11">Testes de Aptidão Física</h2>
                    </div>

                    <div class="row card-sipam border-shadow">
                        @if ($taf_recente != null)
                            <div class="col-12">
                                <div class="row">
                                    <h5 class="col-8 font-large font-small">
                                        Menção obtida no {{ $taf_recente->taf_numero->numero }}
                                    </h5>
                                    <h5 class="col-4 text-end font-large font-color-004aad">
                                        {{ $taf_recente->taf_mencao->pontos }} <ion-icon
                                            name="arrow-up-circle-sharp"></ion-icon>
                                    </h5>
                                    <h5 class="col-12 text-center escolaridade-ficha">
                                        {{ $taf_recente->taf_mencao->mencao }}
                                    </h5>
                                    <h5 class="col-12 text-center font-small">
                                        Publicado no {{ $taf_recente->publicacao->getPublicacao() }}
                                    </h5>
                                </div>
                            </div>

                            @if (!$taf_realizados->isEmpty())
                                <table class="table font-x-small text-center">
                                    <thead>
                                        <th class="">TAF</th>
                                        <th>Menção Obtida</th>
                                        <th>Pontos</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($taf_realizados as $taf)
                                            <tr>
                                                <td>{{ $taf->taf_numero->numero }}</td>
                                                <td>{{ $taf->taf_mencao->mencao }}</td>
                                                <td class="font-color-004aad">{{ $taf->taf_mencao->pontos }} <ion-icon
                                                        name="arrow-up-circle-sharp"></ion-icon></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        @else
                            <div class="col-12 row">
                                <h4 class="col-12 text-center">
                                    O militar não possui Testes de Aptidão Física cadastrados
                                </h4>
                            </div>
                        @endif
                        <br>
                        <a class="btn btn-primary font-small" href="{{ route('taf.create_single', $militar->id) }}">Inserir
                            TAF realizado
                            <ion-icon name="add-circle"></ion-icon></a>
                    </div>
                </div>
            </div>
            <div class="col-4 margin-bottom-5 justify-content-center no-margin">
                <div class="row justify-content-center">
                    <div class="row subtitle-sipam">
                        <h2 class="col-11">Curso de Formação Militar</h2>
                    </div>

                    <div class="row card-sipam border-shadow">
                        @if ($curso_formacao != null)
                            <div class="col-12">
                                <div class="row">
                                    <h5 class="col-8 font-medium font-small">
                                        Curso de Formação concluído:
                                    </h5>
                                    <h5 class="col-4 text-end font-large font-color-004aad">
                                        {{ $curso_formacao->curso_formacao->pontos }} <ion-icon
                                            name="arrow-up-circle-sharp"></ion-icon>
                                    </h5>
                                    <h5 class="col-12 text-center escolaridade-ficha">
                                        {{ $curso_formacao->curso_formacao->nome }}
                                    </h5>
                                    <h5 class="col-12 text-center font-small">
                                        Publicado no {{ $curso_formacao->publicacao->getPublicacao() }}
                                    </h5>
                                </div>
                            </div>
                        @else
                            <div class="col-12 row">
                                <h4 class="col-12 text-center">
                                    O militar não possui Curso de Formação de Condutores cadastrados
                                </h4>
                            </div>
                        @endif
                        <br>
                        <a class="btn btn-primary font-small"
                            href="{{ route('curso_formacao_militar.create', $militar->id) }}">Inserir Curso de
                            Formação Concluído
                            <ion-icon name="add-circle"></ion-icon></a>
                    </div>
                </div>
            </div>
            <div class="col-4 margin-bottom-5 justify-content-center no-margin">
                <div class="row justify-content-center">
                    <div class="row subtitle-sipam">
                        <h2 class="col-11">Curso de Formação de Condutores</h2>
                    </div>

                    <div class="row card-sipam border-shadow">
                        @if ($cnh_militar != null)
                            <div class="col-12">
                                <div class="row">
                                    <h5 class="col-8 font-medium font-small">
                                        Categoria:
                                    </h5>
                                    <h5 class="col-4 text-end font-large font-color-004aad">
                                        {{ $cnh_militar->cnh_categoria->pontos }} <ion-icon
                                            name="arrow-up-circle-sharp"></ion-icon>
                                    </h5>
                                    <h5 class="col-12 text-center escolaridade-ficha">
                                        {{ $cnh_militar->cnh_categoria->categoria }}
                                    </h5>
                                </div>
                            </div>

                            @if (!$taf_realizados->isEmpty())
                            @endif
                        @else
                            <div class="col-12 row">
                                <h4 class="col-12 text-center">
                                    O militar não possui Cursos de Formação Militares cadastrados
                                </h4>
                            </div>
                        @endif
                        <br>
                        <a class="btn btn-primary font-small"
                            href="{{ route('cnh_militar.create', $militar->id) }}">Inserir Categoria de CNH
                            <ion-icon name="add-circle"></ion-icon></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 row justify-content-center card-sipam">
            <div class="col-12 row title-sipam">
                <h2 class="text-center font-large">Atitude</h2>
            </div>
            @if ($avalicao_militar != null)
                <div class="col-4 margin-bottom-5 justify-content-center no-margin">
                    <div class="row justify-content-center">
                        <div class="row subtitle-sipam">
                            <h2 class="col-11">Atributos Básicos</h2>
                        </div>
                        @foreach ($atributos_basicos as $atributo)
                            <div class="row card-sipam border-shadow">
                                <h2 class="col-10 font-small">{{ $atributo->atributo->nome }}</h2>
                                <h2 class="text-center col-2 font-small bg-color-004aad font-color-fff">
                                    {{ $atributo->nota }}</h2>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-4 margin-bottom-5 justify-content-center no-margin">
                    <div class="row justify-content-center">
                        <div class="row subtitle-sipam">
                            <h2 class="col-11">Atributos Funcionais</h2>
                        </div>
                        @foreach ($atributos_funcionais as $atributo)
                            <div class="row card-sipam border-shadow">
                                <h2 class="col-10 font-small">{{ $atributo->atributo->nome }}</h2>
                                <h2 class="text-center col-2 font-small bg-color-004aad font-color-fff">
                                    {{ $atributo->nota }}</h2>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-4 margin-bottom-5 justify-content-center no-margin">
                    <div class="row justify-content-center">
                        <div class="row subtitle-sipam">
                            <h2 class="col-11">Conceito Final</h2>
                        </div>
                        <div class="col-12 text-center font-medium">
                            O conceito final do {{ $militar->getMilitar() }} foi
                        </div>
                        <div class="col-6 text-center bg-color-004aad">
                            <h1 id="nota-final" class="font-color-fff">
                                {{ $avalicao_militar->nota_final }}
                            </h1>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12 justify-content-center no-margin text-center">
                    O militar ainda não possui avaliações concluídas
                </div>
            @endif
        </div>

    </div>

    </div>
@endsection
