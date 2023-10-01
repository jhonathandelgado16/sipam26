@extends('layouts.app')

@section('content')
    <div class="row margin-bottom-15">
        <div class="pull-right col-8">
            <a class="btn btn-white" href="{{ route('ficha_acompanhamentos.index', $militar->id) }}"><img
                    src="{{ url('storage/icons/back.png') }}" height="20"> Voltar</a>
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

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="col-12 row justify-content-center">
            <div class="col-12 row">
                <div class="title-acompanhamento row">
                    <h2 class="col-10">Veículos do Militar</h2>
                    <a class=" col-2 btn btn-acompanhamento font-small" href="{{ route('militar_veiculos.create', $militar->id) }}">Adicionar Veículo
                        <ion-icon name="add-circle"></ion-icon></a>
                </div>
            </div>
            <div class="card-acompanhamento col-12 row justify-content-center">

                @if (!empty($veiculos))
                @foreach ($veiculos as $veiculo)
                <div class="col-4 margin-bottom-10 card-veiculo">
                    <div class="row justify-content-center">
                        <div class="col-12 text-right">
                           <a class=" col-4 btn btn-acompanhamento font-small"
                                href="{{ route('militar_veiculos.edit', $veiculo) }}"> Editar Veículo <ion-icon
                                    name="car"></ion-icon></a>
                        </div>
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
                        <div class="col-6 text-left row">
                            <h4 class="col"><b>Cor:</b> {{ $veiculo->cor }}</h4>
                        </div>
                        <div class="col-6 text-left row">
                            <h4 class="col"><b>Placa:</b> {{ $veiculo->placa }}</h4>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 text-left row">
                            <h4 class="subtittle-acompanhamento">Lista de Verificação:</h4>
                        </div>
                        <div class="col-8 row">
                            <h5 class="col-10 font-small">Documentação</h5>
                            <h5 class="col-2 font-small">
                                @if ($veiculo->documentacao == '1')
                                    <ion-icon name="checkmark-circle"></ion-icon>
                                @else
                                    <ion-icon name="ellipse-outline"></ion-icon>
                                @endif
                            </h5>
                        </div>
                        <div class="col-8 row">
                            <h5 class="col-10 font-small">Pneus</h5>
                            <h5 class="col-2 font-small">
                                @if ($veiculo->pneus == '1')
                                    <ion-icon name="checkmark-circle"></ion-icon>
                                @else
                                    <ion-icon name="ellipse-outline"></ion-icon>
                                @endif
                            </h5>
                        </div>
                        <div class="col-8 row">
                            <h5 class="col-10 font-small">Faróis</h5>
                            <h5 class="col-2 font-small">
                                @if ($veiculo->farois == '1')
                                    <ion-icon name="checkmark-circle"></ion-icon>
                                @else
                                    <ion-icon name="ellipse-outline"></ion-icon>
                                @endif
                            </h5>
                        </div>
                        <div class="col-8 row">
                            <h5 class="col-10 font-small">Luzes de Sinalização</h5>
                            <h5 class="col-2 font-small">
                                @if ($veiculo->luzes_sinalizacao == '1')
                                    <ion-icon name="checkmark-circle"></ion-icon>
                                @else
                                    <ion-icon name="ellipse-outline"></ion-icon>
                                @endif
                            </h5>
                        </div>
                        <div class="col-8 row">
                            <h5 class="col-10 font-small">Retrovisores</h5>
                            <h5 class="col-2 font-small">
                                @if ($veiculo->retrovisores == '1')
                                    <ion-icon name="checkmark-circle"></ion-icon>
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
                                    <ion-icon name="checkmark-circle"></ion-icon>
                                @else
                                    <ion-icon name="ellipse-outline"></ion-icon>
                                @endif
                            </h5>
                        </div>
                        <div class="col-8 row">
                            <h5 class="col-10 font-small">Parabrisas/Limpadores</h5>
                            <h5 class="col-2 font-small">
                                @if ($veiculo->parabrisa_limpador == '1')
                                    <ion-icon name="checkmark-circle"></ion-icon>
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
                                    <ion-icon name="checkmark-circle"></ion-icon>
                                @else
                                    <ion-icon name="ellipse-outline"></ion-icon>
                                @endif
                            </h5>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach

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
    @endsection
