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
                    <h2 class="col-10">Visitas Sociais</h2>
                    <a class=" col-2 btn btn-acompanhamento font-small"
                        href="{{ route('visita_sociais.create', $militar->id) }}">Adicionar Visita
                        <ion-icon name="add-circle"></ion-icon></a>
                </div>
            </div>
            <div class="row card-acompanhamento justify-content-center">
                @if ($visitas_sociais)
                    <div class="col-12 row justify-content-center">
                        @foreach ($visitas_sociais as $visita)
                            <div class="row card-relato">
                                <div class="col-12 text-justify">
                                    <h4><b>Data:</b> {{ date('d/m/Y', strtotime($visita->data)) }}</h4>
                                </div>
                                <div class="col-12 text-justify">
                                    <h4 class="col"><b>Relato:</b> {{ $visita->relato }}</h4>
                                </div>
                            </div>
                        @endforeach
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
    @endsection
