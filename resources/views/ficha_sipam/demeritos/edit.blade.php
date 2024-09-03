@extends('layouts.app')

@section('content')
    <div class="row margin-bottom-15">
        <div class="pull-right col-8">
            <a class="btn btn-white" href="{{ route('ficha_sipam.escolaridade_index', $militar_demerito->militar_id) }}"><img
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
                    <h2 class="col-10">Demérito do Militar</h2>
                </div>
            </div>

            {!! Form::model($militar_demerito, ['method' => 'PATCH','route' => ['ficha_sipam.demerito_update', $militar_demerito->id]]) !!}
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="form-group margin-bottom-5">
                        <div class="row">

                            <div class="col-12">
                                <strong>Demérito:</strong>
                                <select name="demerito_id" class="form-select" required>
                                    @foreach ($demeritos as $demerito)
                                        <option value="{{ $demerito->id }}" 
                                            @if($militar_demerito->demerito_id == $demerito->id)
                                                selected 
                                            @endif>
                                            {{ $demerito->descricao }} - demérito {{ $demerito->pontos_demerito }} pts
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <strong>Publicação:</strong>
                                <input name="publicacao" type="text" class="form-control" value="{{ $militar_demerito->publicacao }}"
                                    placeholder="Ex: BI Nº 1 de 22/03/2023" required>
                            </div>

                            <input name="militar_id" type="number" value="{{ $militar_demerito->militar_id }}" class="d-none">

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
