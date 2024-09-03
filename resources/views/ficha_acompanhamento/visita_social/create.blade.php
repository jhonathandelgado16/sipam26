@extends('layouts.app')

@section('content')
    <div class="row margin-bottom-15">
        <div class="pull-right col-8">
            <a class="btn btn-white" href="{{ route('visita_sociais.index', $militar->id) }}"><img
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
                    <h2 class="col-10">Cadastrar Visita Social</h2>
                </div>
            </div>

            {!! Form::open(['route' => ['visita_sociais.store', $militar->id], 'method' => 'POST']) !!}
            <div class="row" id="cadastrar-curso">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group margin-bottom-5">
                        <div class="row">
                            <div class="col-4">
                                <strong>Data de Conclusão:</strong>
                                <input name="data" type="date" value="{{date('Y-m-d')}}" class="form-control text-center" required>
                            </div>

                            <div class="col-12">
                                <strong>Relato:</strong>
                               <textarea class="form-control" name="relato" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="col-2 btn btn-acompanhamento">Adicionar</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    @endsection
