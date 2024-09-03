@extends('layouts.app')

@section('content')
    <div class="row margin-bottom-15">
        <div class="pull-right col-8">
            <a class="btn btn-white" href="{{ route('militar_veiculos.index', $militar->id) }}"><img
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

        <div class="col-12 row justify-content-center card-acompanhamento">
            <div class="col-12 row">
                <div class="title-acompanhamento row">
                    <h2 class="col-12">Cadastrar Veículo</h2>
                </div>
            </div>

            {!! Form::open(['route' => ['militar_veiculos.update', $veiculo], 'method' => 'PATCH']) !!}
            <div class="row" id="cadastrar-curso">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group margin-bottom-5">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <h4 class="subtitle-acompanhamento">Informações do Veículo</h4>
                                    <div class="col-9">
                                        <strong class="font-small">Modelo:</strong>
                                        <input placeholder="Ex: GOL G5" name="modelo" type="text"
                                            class="form-control text-center" value="{{ $veiculo->modelo }}" required>
                                    </div>

                                    <div class="col-3">
                                        <strong class="font-small">Ano:</strong>
                                        <input class="form-control" placeholder="Ex: 2008" name="ano" type="number"
                                            min="1900" max="2099" value="{{ $veiculo->ano }}" step="1" />
                                    </div>

                                    <div class="col-6">
                                        <strong class="font-small">Cor:</strong>
                                        <input placeholder="Ex: Vermelho" name="cor" type="text"
                                            class="form-control text-center" value="{{ $veiculo->cor }}" required>
                                    </div>

                                    <div class="col-6">
                                        <strong class="font-small">Placa: (apenas números e letras)</strong>
                                        <input placeholder="Ex: BRA2E19" name="placa" type="text"
                                            class="form-control text-center" value="{{ $veiculo->placa }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <h4 class="subtitle-acompanhamento">Lista de Verificação</h4>
                                    <div class="col-12">
                                        <div class="row justify-content-center">
                                            <div class="col-8 row justify-content-center margin-bottom-15">
                                                <strong class="font-small">Tipo do Veículo</strong>
                                                <div class="col-3">
                                                    <input class="form-check-input font-small" type="radio"
                                                        name="tipo_veiculo" id="tipo_veiculo_carro" value="1"
                                                        @if ($veiculo->tipo_veiculo == '1') checked @endif>
                                                    <label class="form-check-label font-small"
                                                        for="tipo_veiculo_carro">Carro</label>
                                                </div>
                                                <div class="col-3">
                                                    <input class="form-check-input font-small" type="radio"
                                                        name="tipo_veiculo" id="tipo_veiculo_moto" value="2"
                                                        @if ($veiculo->tipo_veiculo == '2') checked @endif>
                                                    <label class="form-check-label font-small"
                                                        for="tipo_veiculo_moto">Motocicleta</label>
                                                </div>
                                            </div>

                                            <div class="col-8 row justify-content-center">
                                                <h5 class="col-8 font-small">Documentação</h5>
                                                <div class="col-4 form-check font-small">
                                                    <input class="form-check-input" name="documentacao" type="checkbox"
                                                        value="1" id="documentacao" @if ($veiculo->documentacao == '1') checked @endif>
                                                    <label class="form-check-label" for="documentacao">
                                                        ok
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-8 row justify-content-center">
                                                <h5 class="col-8 font-small">Pneus</h5>
                                                <div class="col-4 form-check font-small">
                                                    <input class="form-check-input" name="pneus" type="checkbox"
                                                        value="1" id="pneus" @if ($veiculo->pneus == '1') checked @endif>
                                                    <label class="form-check-label" for="pneus">
                                                        ok
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-8 row justify-content-center">
                                                <h5 class="col-8 font-small">Faróis</h5>
                                                <div class="col-4 form-check font-small">
                                                    <input class="form-check-input" name="farois" type="checkbox"
                                                        value="1" id="farois" @if ($veiculo->farois == '1') checked @endif>
                                                    <label class="form-check-label" for="farois">
                                                        ok
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-8 row justify-content-center">
                                                <h5 class="col-8 font-small">Luzes de Sinalização</h5>
                                                <div class="col-4 form-check font-small">
                                                    <input class="form-check-input" name="luzes_sinalizacao"
                                                        type="checkbox" value="1" id="luzes_sinalizacao" @if ($veiculo->luzes_sinalizacao == '1') checked @endif>
                                                    <label class="form-check-label" for="luzes_sinalizacao">
                                                        ok
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-8 row justify-content-center">
                                                <h5 class="col-8 font-small">Retrovisores</h5>
                                                <div class="col-4 form-check font-small">
                                                    <input class="form-check-input" name="retrovisores" type="checkbox"
                                                        value="1" id="retrovisores" @if ($veiculo->retrovisores == '1') checked @endif>
                                                    <label class="form-check-label" for="retrovisores">
                                                        ok
                                                    </label>
                                                </div>
                                            </div>
                                            <div @if ($veiculo->tipo_veiculo == '2') style="display: none" @endif class="col-8 row justify-content-center verificacao_carro">
                                                <h5 class="col-8 font-small">Triangulo de Sinalização</h5>
                                                <div class="col-4 form-check font-small">
                                                    <input class="form-check-input" name="triangulo_sinalizacao"
                                                        type="checkbox" value="1" id="triangulo_sinalizacao" @if ($veiculo->triangulo_sinalizacao == '1') checked @endif>
                                                    <label class="form-check-label" for="triangulo_sinalizacao">
                                                        ok
                                                    </label>
                                                </div>
                                            </div>
                                            <div @if ($veiculo->tipo_veiculo == '2') style="display: none" @endif class="col-8 row justify-content-center verificacao_carro">
                                                <h5 class="col-8 font-small">Parabrisas/Limpadores</h5>
                                                <div class="col-4 form-check font-small">
                                                    <input class="form-check-input" name="parabrisa_limpador"
                                                        type="checkbox" value="1" id="parabrisa_limpador" @if ($veiculo->parabrisa_limpador == '1') checked @endif>
                                                    <label class="form-check-label" for="parabrisa_limpador">
                                                        ok
                                                    </label>
                                                </div>
                                            </div>
                                            <div @if ($veiculo->tipo_veiculo == '1') style="display: none" @endif
                                                id="verificacao_moto" class="col-8 row justify-content-center">
                                                <h5 class="col-8 font-small">Capacete INMETRO</h5>
                                                <div class="col-4 form-check font-small">
                                                    <input class="form-check-input" name="capacete" type="checkbox"
                                                        value="1" id="capacete" @if ($veiculo->capacete == '1') checked @endif>
                                                    <label class="form-check-label" for="capacete">
                                                        ok
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        <script>
            $(document).ready(function() {

                $('#tipo_veiculo_carro').on('change', function() {
                    selected_value = $("input[name='tipo_veiculo']:checked").val();
                    if (selected_value == "1") {
                        $('.verificacao_carro').show();
                        $('#verificacao_moto').hide();
                    }
                });

                $('#tipo_veiculo_moto').on('change', function() {
                    selected_value = $("input[name='tipo_veiculo']:checked").val();
                    if (selected_value == "2") {
                        $('.verificacao_carro').hide();
                        $('#verificacao_moto').show();
                    }
                });

                $('#anterior').on("click", function() {
                    $('#dados-familiares').removeClass('d-none');
                    $('#instrucoes').addClass('d-none');
                    $('#first-form').removeClass('d-none');
                    $('#second-form').addClass('d-none');
                });
            });
        </script>
    @endsection
