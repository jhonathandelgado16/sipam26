@extends('layouts.app')

@section('content')
    <div class="row margin-bottom-15">
        <div class="pull-right col-8">
            <a class="btn btn-white" href="{{ route('ficha_sipam.index', $militar->id) }}"><img
                    src="{{ url('storage/icons/back.png') }}" height="20"> Voltar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left title-sipam text-center">
                <h2 class="font-large">Cadastrar Teste de Aptidão Física realizado</h2>
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


    {!! Form::open(['route' => 'taf.store_single', 'method' => 'POST']) !!}

    <input value="{{ $militar->id }}" type="number" class="d-none" name="militar_id">

    <div class="row justify-content-center">
        <div class="col-2">
            <div class="form-group">
                <strong>Selecionar TAF</strong>
                <select id="numero" class="form-select" name="taf_numero_id">
                    <option value="">Selecione o TAF</option>
                    @foreach ($numeros as $numero)
                        <option value="{{ $numero->id }}">{{ $numero->numero }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-7">
            <div class="form-group">
                <strong>Selecionar documento de Publicação do TAF</strong>
                <select id="publicacao" class="form-select" name="publicacao_id">
                    <option value="">Selecione a publicação</option>
                    @foreach ($publicacoes as $publicacao)
                        <option value="{{ $publicacao->id }}">{{ $publicacao->getPublicacaoCompleta() }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <strong>Menção obtida</strong>
                <select id="mencao" class="form-select text-center" name="taf_mencao_id">
                    <option value="">Selecione a menção</option>
                    @foreach ($mencoes as $mencao)
                        <option value="{{ $mencao->id }}"><b>{{ $mencao->mencao }}</b></option>
                    @endforeach
                </select>
            </div>
        </div>

        <div id="descricao" class="subtitle-sipam font-large">

        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="col-3 btn btn-sipam text-large">Adicionar</button>
        </div>
    </div>
    {!! Form::close() !!}

    <script>
        $(document).ready(function() {
            $("select").on("change", function() {
                $('#descricao').html(
                    '<div class="text-center color-red"><b><ion-icon name="warning"></ion-icon> ATENÇÃO, LEIA A DESCRIÇÃO DO TAF QUE SERÁ CADASTRADO <ion-icon name="warning"></ion-icon></b></div><b>{{ $militar->getMilitar() }}</b> realizou o <b>' +
                    $("#numero :selected").text() + '</b> publicado no <b>' + $("#publicacao :selected")
                    .text() + '</b> e obteve a menção <b>' + $("#mencao :selected").text() + '</b>');
            });
        });
    </script>
@endsection
