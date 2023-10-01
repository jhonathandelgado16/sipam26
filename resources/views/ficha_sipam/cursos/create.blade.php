@extends('layouts.app')

@section('content')
    <div class="row margin-bottom-15">
        <div class="pull-right col-8">
            <a class="btn btn-white" href="{{ route('cursos.encontrar', $militar->id) }}"><img
                    src="{{ url('storage/icons/back.png') }}" height="20"> Voltar</a>
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
                <div class="title-sipam row">
                    <h2 class="col-10">Cadastrar Cursos e Estágios</h2>
                </div>
            </div>

            {!! Form::open(['route' => 'ficha_sipam.curso_store', 'method' => 'POST']) !!}
            <div class="row" id="cadastrar-curso">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group margin-bottom-5">
                        <div class="row">

                            <div class="col-12">
                                <strong>Nome do Curso ou Estágio:</strong>
                                <input name="nome" type="text" class="form-control" 
                                @if ($curso != '')
                                    value="{{$curso->nome}}"
                                    readonly
                                @endif
                                    placeholder="Ex: Programador de Sistemas" required>
                            </div>

                            <div class="col-4">
                                <strong>Carga horária:</strong>
                                <input name="horas" type="number" class="form-control"
                                @if ($curso != '')
                                    value="{{$curso->horas}}"
                                    readonly
                                @endif
                                    placeholder="Ex: 40" required>
                            </div>

                            <div class="col-4">
                                <strong>Data de Conclusão:</strong>
                                <input name="data_conclusao" type="date" value="{{date('Y-m-d')}}" class="form-control text-center" required>
                            </div>

                            <div class="col-12">
                                <strong>Instituição de Ensino:</strong>
                                <input name="instituicao_ensino" type="text" class="form-control"
                                @if ($curso != '')
                                    value="{{$curso->instituicao_ensino}}"
                                    readonly
                                @endif
                                    placeholder="Ex: SENAC" required>
                            </div>

                            <input name="militar_id" type="number" value="{{ $militar->id }}" class="d-none">
                            @if ($curso != '')
                                <input name="curso_id" type="number" value="{{ $curso->id }}" class="d-none">
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="col-2 btn btn-sipam">Adicionar</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    @endsection
