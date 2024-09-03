@extends('layouts.app')

@section('content')
    <div class="row margin-bottom-15">
        <div class="pull-right col-8">
            <a class="btn btn-white" href="{{ route('ficha_sipam.escolaridade_index', $militar_escolaridade->militar_id) }}"><img
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
                    <h2 class="col-10">Escolaridade do Militar</h2>
                </div>
            </div>

            {!! Form::model($militar_escolaridade, ['method' => 'PATCH','route' => ['ficha_sipam.escolaridade_update', $militar_escolaridade->id]]) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group margin-bottom-5">
                        <div class="row">

                            <div class="col-6">
                                <strong>Escolaridade:</strong>
                                <select name="escolaridade_id" class="form-select">
                                    @foreach ($escolaridades as $escolaridade)
                                        <option value="{{ $escolaridade->id }}" 
                                            @if($militar_escolaridade->escolaridade_id == $escolaridade->id)
                                                selected 
                                            @endif>
                                            {{ $escolaridade->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <strong>Instituição de Ensino:</strong>
                                <input name="instituicao_ensino" type="text" class="form-control" value="{{ $militar_escolaridade->instituicao_ensino }}"
                                    placeholder="Ex: Universidade Estadual do Centro Oeste" required>
                            </div>

                            <input name="militar_id" type="number" value="{{ $militar_escolaridade->militar_id }}" class="d-none">

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="col-2 btn btn-sipam">Editar</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    @endsection
