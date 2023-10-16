@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left title-sipam text-center">
                <h2 class="font-large">Cadastrar Teste de Aptidão Física realizado</h2>
            </div>
            <div class="pull-right">
                {{-- <a class="btn btn-white" href="{{ route('publicacoes.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a> --}}
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


    {!! Form::open(['route' => 'taf.store', 'method' => 'POST']) !!}
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

        <div class="col-12 row">
            @foreach ($militares as $militares_divisao)
                <div class="col-4">
                    @foreach ($militares_divisao as $militar)
                        <div class="row card-taf cursor-pointer">
                            <input class="form-check col-2 cursor-pointer" name="militares[]" type="checkbox"
                                value="{{ $militar->id }}" id="{{ $militar->id }}">
                            <label class="col-10 cursor-pointer" for="{{ $militar->id }}">
                                {{ $militar->getMilitar() }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </div>
    </div>
    {!! Form::close() !!}
    <script>
        $(document).ready(function() {
            $("select").on("change", function() {
                $('#descricao').html('<div class="text-center color-red"><b><ion-icon name="warning"></ion-icon> ATENÇÃO <ion-icon name="warning"></ion-icon></b></div>Selecione apenas os militares que realizaram o <b>'+ $("#numero :selected").text() +'</b> publicado no <b>'+ $("#publicacao :selected").text() +'</b> e obtiveram a menção <b>'+ $("#mencao :selected").text()+'</b>');
            });
        });
    </script>
@endsection
