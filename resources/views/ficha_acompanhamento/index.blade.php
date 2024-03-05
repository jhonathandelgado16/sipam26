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
                <h2 class="title-acompanhamento">Ficha de Acompanhamento</h2>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 row margin-bottom-10 justify-content-center">
            <div class="row card-acompanhamento">
                <div class="col-2 row justify-content-center">
                    <img class="col-md-10" src="{{ url('storage/perfil.png') }}">
                </div>
                <div class="col-10 row">
                    <h3 class="text-center">{{ $militar->getMilitar() }}</h3>
                    <div class="col-4">
                        <div class="row">
                            <h2 class="subtitle-acompanhamento text-center">Informações Institucionais</h2>
                            <div class="col-12 text-left row">
                                <h4><b>OM:</b> 26º GAC</h4>
                            </div>
                            <div class="col-12 text-left row">
                                <h4><b>Subunidade:</b> {{ $militar->subunidade->nome }}</h4>
                            </div>
                            <div class="col-12 text-left row">
                                <h4 class=""><b>Fração:</b> {{ $militar->pelotao->pelotao }}
                                </h4>
                            </div>
                            <div class="col-12 text-left row">
                                <h4><b>Cmt:</b> {{ $militar->pelotao->cmt_pelotao }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <h2 class="subtitle-acompanhamento text-center">Dados do Militar</h2>
                            <div class="col-3 text-left row">
                                <h4 class=""><b>P/G:</b> {{ $militar->posto->posto }}</h4>
                            </div>
                            <div class="col-9 text-left row">
                                <h4 class=""><b>Nome Completo:</b> {{ $militar->nome }}</h4>
                            </div>
                            <div class="col-4 text-left row">
                                <h4 class="col"><b>CPF:</b> {{ $militar->cpf }}</h4>
                            </div>
                            <div class="col-4 text-left row">
                                <h4 class="col"><b>IDT:</b> {{ $militar->idt_militar }}</h4>
                            </div>
                            <div class="col-4 text-left row">
                                <h4 class="col"><b>Contato:</b> {{ $militar->contato }}</h4>
                            </div>
                            <div class="col-12 text-left row">
                                <h4 class="col-12"><b>Endereço:</b> {{ $militar->endereco }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @if ($ficha != null)
        <div class="col-12">
            <div class="row justify-content-center">
                <a target="_blank" class="col-4 btn btn-acompanhamento" href="{{ route('ficha_acompanhamentos.pdf', $ficha) }}"><ion-icon name="document"></ion-icon> Gerar PDF</a>
            </div>
        </div>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-12 row margin-bottom-5 justify-content-center no-margin">
                    <div class="row subtitle-acompanhamento">
                        <h2 class="col-10">Dados Familiares</h2>
                        @if ($ficha)
                            <a class=" col-2 btn btn-acompanhamento font-small"
                                href="{{ route('ficha_acompanhamentos.edit', $militar->id) }}"> Editar dados <ion-icon
                                    name="create"></ion-icon></a>
                        @endif
                    </div>

                    <div class="row card-acompanhamento">
                        @if ($ficha)
                            <div class="col-12 row justify-content-center">
                                <div class="col-8 margin-bottom-10">
                                    <div class="row">
                                        <div class="col-12 text-left row">
                                            <h4 class=""><b>Nome da Esposa:</b> {{ $ficha->nome_esposa }}</h4>
                                        </div>
                                        <div class="col-12 text-left row">
                                            <h4 class="col"><b>Contato da Esposa:</b> {{ $ficha->contato_esposa }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8 margin-bottom-10">
                                    <div class="row">
                                        <div class="col-12 text-left row">
                                            <h4 class=""><b>Nome do Pai ou Responsável:</b> {{ $ficha->nome_pai }}
                                            </h4>
                                        </div>
                                        <div class="col-12 text-left row">
                                            <h4 class="col"><b>Contato do Pai ou Responsável:</b>
                                                {{ $ficha->contato_pai }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8 margin-bottom-10">
                                    <div class="row">
                                        <div class="col-12 text-left row">
                                            <h4 class=""><b>Nome da Mãe ou Responsável:</b> {{ $ficha->nome_mae }}
                                            </h4>
                                        </div>
                                        <div class="col-12 text-left row">
                                            <h4 class="col"><b>Contato da Mãe ou Responsável:</b>
                                                {{ $ficha->contato_mae }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8 margin-bottom-10">
                                    <div class="row">
                                        <div class="col-6 text-left row">
                                            <h4 class=""><b>Quantidade de Imrãos:</b> {{ $ficha->qtd_irmaos }}
                                            </h4>
                                        </div>
                                        <div class="col-6 text-left row">
                                            <h4 class="col"><b>Renda familiar média:</b>
                                               R$ {{ $ficha->renda_familiar }}
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-left row">
                                            <h4 class=""><b>Objetivo de vida:</b> {{ $ficha->objetivo_de_vida }}
                                            </h4>
                                        </div>
                                        <div class="col-12 text-left row">
                                            <h4 class="col"><b>Lazer:</b>
                                                {{ $ficha->lazer }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8 margin-bottom-10">
                                    <div class="row">
                                        <div class="col-12 text-left row">
                                            <h4 class=""><b>Em caso de Acidente, ligar para:</b>
                                            </h4>
                                        </div>
                                        <div class="col-12 text-left row">
                                            <h4 class=""><b>Quem?</b>
                                                {{ $ficha->nome_pai }}
                                            </h4>
                                        </div>
                                        <div class="col-12 text-left row">
                                            <h4 class="col"><b>Número de telefone:</b>
                                                {{ $ficha->contato_pai }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12 row">
                                <h4 class="col-12 text-center">
                                    O militar não possui dados familiares cadastrados, deseja preencher? <br>
                                    <a class="col-3 btn btn-acompanhamento font-small"
                                        href="{{ route('ficha_acompanhamentos.create', $militar->id) }}">Preencher dados
                                        <ion-icon name="add-circle"></ion-icon></a>
                                </h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-12 row margin-bottom-5 justify-content-center no-margin">
                    <div class="row subtitle-acompanhamento">
                        <h2 class="col-10">Instruções</h2>
                        @if ($ficha)
                            <a class=" col-2 btn btn-acompanhamento font-small"
                                href="{{ route('ficha_acompanhamentos.edit', $militar->id) }}"> Editar dados <ion-icon
                                    name="create"></ion-icon></a>
                        @endif
                    </div>

                    <div class="row card-acompanhamento">
                        @if ($ficha)
                            <div row class="col-12 row justify-content-center">
                                <div class="col-8 margin-bottom-10">
                                    <div class="row justify-content-center">
                                        <div class="col-12 row">
                                            <h4 class=""><b>Assistiu à Palestra de Prevenção de Acidentes nas
                                                    Atividades
                                                    Militares?</b> </h4>
                                        </div>
                                        <div class="col-12 row justify-content-center">
                                            <div class="col-4">
                                                <label class="">
                                                    @if ($ficha->acidentes_atividades_militares == 1)
                                                        <ion-icon name="checkmark-circle"></ion-icon> Sim
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon> Sim
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="col-4">
                                                <label class="">
                                                    @if ($ficha->acidentes_atividades_militares == 2)
                                                        <ion-icon name="checkmark-circle"></ion-icon> Não
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon> Não
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="col-4">
                                                <label class="">
                                                    @if ($ficha->acidentes_atividades_militares == 3)
                                                        <ion-icon name="checkmark-circle"></ion-icon> Palestra de
                                                        Recuperação
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon> Palestra de
                                                        Recuperação
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 row">
                                            <h4 class="">BI que publicou:
                                                {{ $ficha->acidentes_atividades_militares_bi }}</h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-8 margin-bottom-10">
                                    <div class="row justify-content-center">
                                        <div class="col-12 row">
                                            <h4 class=""><b>Assistiu à Palestra de Prevenção de Acidentes
                                                    Automobilísticos?</b> </h4>
                                        </div>
                                        <div class="col-12 row justify-content-center">
                                            <div class="col-4">
                                                <label class="">
                                                    @if ($ficha->acidentes_automobilisticos == 1)
                                                        <ion-icon name="checkmark-circle"></ion-icon> Sim
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon> Sim
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="col-4">
                                                <label class="">
                                                    @if ($ficha->acidentes_automobilisticos == 2)
                                                        <ion-icon name="checkmark-circle"></ion-icon> Não
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon> Não
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="col-4">
                                                <label class="">
                                                    @if ($ficha->acidentes_automobilisticos == 3)
                                                        <ion-icon name="checkmark-circle"></ion-icon> Palestra de
                                                        Recuperação
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon> Palestra de
                                                        Recuperação
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 row">
                                            <h4 class="">BI que publicou:
                                                {{ $ficha->acidentes_automobilisticos_bi }}</h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-8 margin-bottom-10">
                                    <div class="row justify-content-center">
                                        <div class="col-12 row">
                                            <h4 class=""><b>Possui Carteira Nacional de Habilitação?</b></h4>
                                        </div>
                                        <div class="col-12 row justify-content-center">
                                            <div class="col-8">

                                            </div>
                                            <div class="col-2">
                                                <label class="">
                                                    @if ($ficha->possui_cnh == 1)
                                                        <ion-icon name="checkmark-circle"></ion-icon> Sim
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon> Sim
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="col-2">
                                                <label class="">
                                                    @if ($ficha->possui_cnh == 2)
                                                        <ion-icon name="checkmark-circle"></ion-icon> Não
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon> Não
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-8 margin-bottom-10">
                                    <div class="row justify-content-center">
                                        <div class="col-12 row">
                                            <h4 class=""><b>Se Categoria A, realizou o Estágio de Prevenção de
                                                    Acidentes
                                                    Motociclísticos?</b></h4>
                                        </div>
                                        <div class="col-12 row justify-content-center">
                                            <div class="col-4">
                                                <label class="">
                                                    @if ($ficha->acidentes_motociclisticos == 1)
                                                        <ion-icon name="checkmark-circle"></ion-icon> Sim
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon> Sim
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="col-4">
                                                <label class="">
                                                    @if ($ficha->acidentes_motociclisticos == 2)
                                                        <ion-icon name="checkmark-circle"></ion-icon> Não
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon> Não
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="col-4">
                                                <label class="">
                                                    @if ($ficha->acidentes_motociclisticos == 3)
                                                        <ion-icon name="checkmark-circle"></ion-icon> Palestra de
                                                        Recuperação
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon> Palestra de
                                                        Recuperação
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="col-12 row">
                                                <h4 class="">BI que publicou:
                                                    {{ $ficha->acidentes_motociclisticos_bi }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-12 row">
                                            <h4 class="">Como foi classificada a perícia na condução de motocicleta?
                                            </h4>
                                        </div>
                                        <div class="col-12 row justify-content-center">
                                            <div class="col-2">
                                                <label class="">
                                                    @if ($ficha->conducao_motocicleta == 'E')
                                                        <ion-icon name="checkmark-circle"></ion-icon> E
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon> E
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="col-2">
                                                <label class="">
                                                    @if ($ficha->conducao_motocicleta == 'MB')
                                                        <ion-icon name="checkmark-circle"></ion-icon> MB
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon> MB
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="col-2">
                                                <label class="">
                                                    @if ($ficha->conducao_motocicleta == 'B')
                                                        <ion-icon name="checkmark-circle"></ion-icon> B
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon> B
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="col-2">
                                                <label class="">
                                                    @if ($ficha->conducao_motocicleta == 'R')
                                                        <ion-icon name="checkmark-circle"></ion-icon> R
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon> R
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="col-2">
                                                <label class="">
                                                    @if ($ficha->conducao_motocicleta == 'I')
                                                        <ion-icon name="checkmark-circle"></ion-icon> I
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon> I
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12 row">
                                <h4 class="col-12 text-center">
                                    O militar não possui instruções cadastrados, deseja cadastrar? <br>
                                    <a class="col-3 btn btn-acompanhamento font-small"
                                        href="{{ route('ficha_acompanhamentos.create', $militar->id) }}">Preencher dados
                                        <ion-icon name="add-circle"></ion-icon></a>
                                </h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="row">
                <div class="col-12 row margin-bottom-5 justify-content-center no-margin">
                    <div class="row subtitle-acompanhamento">
                        <h2 class="col-8">Visita Social</h2>
                        @if (!$visita_sociais->isEmpty())
                            <a class=" col-4 btn btn-acompanhamento font-small"
                                href="{{ route('visita_sociais.index', $militar->id) }}"> Visualizar Visitas <ion-icon
                                    name="search-circle" size="small"></ion-icon></a>
                        @endif
                    </div>

                    <div class="row card-acompanhamento justify-content-center">
                        @if (!$visita_sociais->isEmpty())
                            <div class="col-12 row justify-content-center">
                                @foreach ($visita_sociais as $visita)
                                    <div class="row card-relato">
                                        <div class="col-12 text-justify">
                                            <h4><b>Data:</b> {{ date('d/m/Y', strtotime($visita->data)) }}</h4>
                                        </div>
                                        <div class="col-12 text-justify">
                                            <h4 class="col"><b>Relato:</b> {{ $visita->relato }}</h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="col-12 row">
                                <h4 class="col-12 text-center">
                                    O militar não possui visitas sociais inseridas, deseja inserir? <br>
                                    <a class="col-3 btn btn-acompanhamento font-small"
                                        href="{{ route('visita_sociais.create', $militar->id) }}">Inserir dados <ion-icon
                                            name="add-circle"></ion-icon></a>
                                </h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="row">
                <div class="col-12 row margin-bottom-5 justify-content-center no-margin">
                    <div class="row subtitle-acompanhamento">
                        <h2 class="col-8">Veículos</h2>
                        @if (!$veiculos->isEmpty())
                            <a class=" col-4 btn btn-acompanhamento font-small"
                                href="{{ route('militar_veiculos.index', $militar->id) }}"> Visualizar Veículos <ion-icon
                                    name="car"></ion-icon></a>
                        @endif
                    </div>
                    <div class="row card-acompanhamento">

                        @if (!$veiculos->isEmpty())
                            <div class="col-12">
                                @foreach ($veiculos as $veiculo)
                                    <div class="col margin-bottom-10 card-veiculo">
                                        <div class="row justify-content-center">
                                            <div class="col-8 text-center row">
                                                @if ($veiculo->tipo_veiculo == '1')
                                                    <h5 class="font-x-large"><ion-icon name="car"></ion-icon></h5>
                                                @else
                                                    <h5 class="font-x-large"><ion-icon name="bicycle"></ion-icon></h5>
                                                @endif
                                            </div>
                                            <div class="col-8 text-left row">
                                                <h4 class=""><b>Modelo:</b> {{ $veiculo->modelo }}</h4>
                                            </div>
                                            <div class="col-4 text-left row">
                                                <h4 class=""><b>Ano:</b> {{ $veiculo->ano }}</h4>
                                            </div>
                                            <div class="col-8 text-left row">
                                                <h4 class="col"><b>Cor:</b> {{ $veiculo->cor }}</h4>
                                            </div>
                                            <div class="col-4 text-left row">
                                                <h4 class="col"><b>Placa:</b> {{ $veiculo->placa }}</h4>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-12 text-left row">
                                                <h4 class="">Lista de Verificação:</h4>
                                            </div>
                                            <div class="col-8 row">
                                                <h5 class="col-10 font-small">Documentação</h5>
                                                <h5 class="col-2 font-small">
                                                    @if ($veiculo->documentacao == '1')
                                                        <ion-icon name="checkmark-circle"></ion-icon> ok
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon>
                                                    @endif
                                                </h5>
                                            </div>
                                            <div class="col-8 row">
                                                <h5 class="col-10 font-small">Pneus</h5>
                                                <h5 class="col-2 font-small">
                                                    @if ($veiculo->pneus == '1')
                                                        <ion-icon name="checkmark-circle"></ion-icon> ok
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon>
                                                    @endif
                                                </h5>
                                            </div>
                                            <div class="col-8 row">
                                                <h5 class="col-10 font-small">Faróis</h5>
                                                <h5 class="col-2 font-small">
                                                    @if ($veiculo->farois == '1')
                                                        <ion-icon name="checkmark-circle"></ion-icon> ok
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon>
                                                    @endif
                                                </h5>
                                            </div>
                                            <div class="col-8 row">
                                                <h5 class="col-10 font-small">Luzes de Sinalização</h5>
                                                <h5 class="col-2 font-small">
                                                    @if ($veiculo->luzes_sinalizacao == '1')
                                                        <ion-icon name="checkmark-circle"></ion-icon> ok
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon>
                                                    @endif
                                                </h5>
                                            </div>
                                            <div class="col-8 row">
                                                <h5 class="col-10 font-small">Retrovisores</h5>
                                                <h5 class="col-2 font-small">
                                                    @if ($veiculo->retrovisores == '1')
                                                        <ion-icon name="checkmark-circle"></ion-icon> ok
                                                    @else
                                                        <ion-icon name="ellipse-outline"></ion-icon>
                                                    @endif
                                                </h5>
                                            </div>

                                            @if ($veiculo->tipo_veiculo == '1')
                                                <div class="col-8 row">
                                                    <h5 class="col-10 font-small">Triangulo de Sinalização</h5>
                                                    <h5 class="col-2 font-small">
                                                        @if ($veiculo->triangulo_sinalizacao == '1')
                                                            <ion-icon name="checkmark-circle"></ion-icon> ok
                                                        @else
                                                            <ion-icon name="ellipse-outline"></ion-icon>
                                                        @endif
                                                    </h5>
                                                </div>
                                                <div class="col-8 row">
                                                    <h5 class="col-10 font-small">Parabrisas/Limpadores</h5>
                                                    <h5 class="col-2 font-small">
                                                        @if ($veiculo->parabrisa_limpador == '1')
                                                            <ion-icon name="checkmark-circle"></ion-icon> ok
                                                        @else
                                                            <ion-icon name="ellipse-outline"></ion-icon>
                                                        @endif
                                                    </h5>
                                                </div>
                                            @else
                                                <div class="col-8 row">
                                                    <h5 class="col-10 font-small">Capacete INMETRO</h5>
                                                    <h5 class="col-2 font-small">
                                                        @if ($veiculo->capacete == '1')
                                                            <ion-icon name="checkmark-circle"></ion-icon> ok
                                                        @else
                                                            <ion-icon name="ellipse-outline"></ion-icon>
                                                        @endif
                                                    </h5>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="col-12 row">
                                <h4 class="col-12 text-center">
                                    O militar não possui veículos cadastrados, deseja cadastrar? <br>
                                    <a class="col-3 btn btn-acompanhamento font-small" href="{{route('militar_veiculos.create', $militar->id)}}">Inserir veículo
                                        <ion-icon name="add-circle"></ion-icon></a>
                                </h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-12 row margin-bottom-5 justify-content-center no-margin">
                    <div class="row subtitle-acompanhamento">
                        <h2 class="col-10">Observações</h2>
                        <a class=" col-2 btn btn-acompanhamento font-small" target="_blank"
                            href="{{ route('obs.inserir', $militar->id) }}"> Cadastrar nova observação <ion-icon
                                name="create"></ion-icon></a>
                    </div>
                    <div class="row card-acompanhamento">
                        @if (!$observacoes->isEmpty())

                        @else
                            <div class="col-12 row">
                                <h4 class="col-12 text-center">
                                    O militar não possui observações cadastradas, deseja cadastrar? <br>
                                    <a class="col-3 btn btn-acompanhamento font-small" target="_blank"
                                        href="{{ route('obs.inserir', $militar->id) }}">Preencher dados
                                        <ion-icon name="add-circle"></ion-icon></a>
                                </h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
@endsection
