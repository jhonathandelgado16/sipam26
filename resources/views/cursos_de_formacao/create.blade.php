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
                <h2 class="font-large">Cadastrar Curso de Formação concluído</h2>
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


    {!! Form::open(['route' => 'curso_formacao_militar.store', 'method' => 'POST']) !!}

    <input value="{{ $militar->id }}" type="number" class="d-none" name="militar_id">

    <div class="row justify-content-center">
        <div class="col-4">
            <div class="form-group">
                <strong>Selecionar o Curso de Formação Concluído</strong>
                <select class="form-select" name="curso_formacao_id">
                    <option value="">Selecione o Curso de Formação</option>
                    @foreach ($cursos_formacao as $curso_formacao)
                        <option value="{{ $curso_formacao->id }}">{{ $curso_formacao->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-8">
            <div class="form-group">
                <strong>Selecionar documento de Publicação da Conclusão do Curso</strong>
                <select id="publicacao" class="form-select" name="publicacao_id">
                    <option value="">Selecione a publicação</option>
                    @foreach ($publicacoes as $publicacao)
                        <option value="{{ $publicacao->id }}">{{ $publicacao->getPublicacaoCompleta() }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="col-3 btn btn-sipam text-large">Adicionar</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
