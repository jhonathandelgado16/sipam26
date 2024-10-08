@extends('layouts.app')

@section('content')
    <div class="row margin-bottom-15">
        <div class="pull-right col-8">
            <a class="btn btn-white" href="{{ route('ficha_acompanhamentos.index', $militar->id) }}"><img
                    src="{{ url('storage/icons/back.png') }}" height="20"> Voltar</a>
        </div>
    </div>

    <div class="row margin-bottom-10">
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <h2 class="title-acompanhamento">Editar Ficha de Acompanhamento</h2>
            </div>
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
        {!! Form::open([
            'route' => ['ficha_acompanhamentos.update', $militar->id],
            'method' => 'PATCH',
            'class' => 'col-12',
        ]) !!}
        <div class="row justify-content-center">
            <div class="col-12" id="dados-familiares">
                <div class="row justify-content-center">
                    <div class="col-12 row margin-bottom-5 justify-content-center no-margin">
                        <div class="row subtitle-acompanhamento">
                            <h2 class="col-10">Preencher Dados Familiares</h2>
                        </div>

                        <div class="row card-acompanhamento">
                            <div class="col-12 row justify-content-center">
                                <div class="col-10 margin-bottom-10">
                                    <div class="row">
                                        <div class="col-8 text-left">
                                            <h4 class=""><b>Nome da Esposa:</b></h4>
                                            {!! Form::text('nome_esposa', $ficha->nome_esposa, [
                                                'placeholder' => 'Digite o nome',
                                                'class' => 'form-control margin-side-5 font-small',
                                            ]) !!}
                                        </div>
                                        <div class="col-4 text-left">
                                            <h4 class=""><b>Contato da Esposa:</b></h4>
                                            {!! Form::text('contato_esposa', $ficha->contato_esposa, [
                                                'placeholder' => 'Digite o contato',
                                                'class' => 'form-control font-small',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 margin-bottom-10">
                                    <div class="row">
                                        <div class="col-8 text-left">
                                            <h4 class=""><b>Nome do Pai ou Responsável:</b></h4>
                                            {!! Form::text('nome_pai', $ficha->nome_pai, [
                                                'placeholder' => 'Digite o nome',
                                                'class' => 'form-control margin-side-5 font-small',
                                            ]) !!}
                                        </div>
                                        <div class="col-4 text-left">
                                            <h4 class=""><b>Contato do Pai ou Responsável:</b></h4>
                                            {!! Form::text('contato_pai', $ficha->contato_pai, [
                                                'placeholder' => 'Digite o contato',
                                                'class' => 'form-control font-small',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 margin-bottom-10">
                                    <div class="row">
                                        <div class="col-8 text-left">
                                            <h4 class=""><b>Nome da Mãe ou Responsável:</b></h4>
                                            {!! Form::text('nome_mae', $ficha->nome_mae, [
                                                'placeholder' => 'Digite o nome',
                                                'class' => 'form-control margin-side-5 font-small',
                                            ]) !!}
                                        </div>
                                        <div class="col-4 text-left">
                                            <h4 class=""><b>Contato da Mãe ou Responsável:</b></h4>
                                            {!! Form::text('contato_mae', $ficha->contato_mae, [
                                                'placeholder' => 'Digite o contato',
                                                'class' => 'form-control font-small',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 margin-bottom-10">
                                    <div class="row">
                                        <div class="col-3 text-left">
                                            <h4 class=""><b>Quantidade de Irmãos:</b></h4>
                                            {!! Form::number('qtd_irmaos', $ficha->qtd_irmaos, ['placeholder' => 'nº de irmãos', 'class' => 'form-control margin-side-5 font-small']) !!}
                                        </div>
                                        <div class="col-3 text-left">
                                            <h4 class=""><b>Média de Renda Familiar:</b></h4>
                                            {!! Form::number('renda_familiar', $ficha->renda_familiar, ['placeholder' => 'Média renda familiar R$', 'class' => 'form-control font-small']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 margin-bottom-10">
                                    <div class="row">
                                        <div class="col-12 text-left">
                                            <h4 class=""><b>Objetivos de Vida:</b></h4>
                                            <textarea class="form-control" name="objetivo_de_vida" id="" cols="1" rows="3">{{$ficha->objetivo_de_vida}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 margin-bottom-10">
                                    <div class="row">
                                        <div class="col-12 text-left">
                                            <h4 class=""><b>Lazer:</b></h4>
                                            <textarea class="form-control" name="lazer" id="" cols="1" rows="1">{{$ficha->lazer}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 d-none" id="instrucoes">
                <div class="row justify-content-center">
                    <div class="col-12 row margin-bottom-5 justify-content-center no-margin">
                        <div class="row subtitle-acompanhamento">
                            <h2 class="col-10">Instruções</h2>
                        </div>

                        <div class="row card-acompanhamento">
                            <div row class="col-12 row justify-content-center">
                                <div class="col-8 margin-bottom-25">
                                    <div class="row justify-content-center">
                                        <div class="col-12 row">
                                            <h4 class=""><b>Assistiu à Palestra de Prevenção de Acidentes nas
                                                    Atividades
                                                    Militares?</b> </h4>
                                        </div>
                                        <div class="col-12 row justify-content-center">
                                            <div class="col-4">
                                                <input class="form-check-input font-small" type="radio"
                                                    name="acidentes_atividades_militares"
                                                    id="acidentes_atividades_militares_sim" value="1"
                                                    @if ($ficha->acidentes_atividades_militares == '1') checked @endif>
                                                <label class="form-check-label font-small"
                                                    for="acidentes_atividades_militares_sim">Sim</label>
                                            </div>
                                            <div class="col-4">
                                                <input class="form-check-input font-small" type="radio"
                                                    name="acidentes_atividades_militares"
                                                    id="acidentes_atividades_militares_nao" value="2"
                                                    @if ($ficha->acidentes_atividades_militares == '2') checked @endif>
                                                <label class="form-check-label font-small"
                                                    for="acidentes_atividades_militares_nao">Não</label>
                                            </div>
                                            <div class="col-4">
                                                <input class="form-check-input font-small" type="radio"
                                                    name="acidentes_atividades_militares"
                                                    id="acidentes_atividades_militares_recuperacao" value="3"
                                                    @if ($ficha->acidentes_atividades_militares == '3') checked @endif>
                                                <label class="form-check-label font-small"
                                                    for="acidentes_atividades_militares_recuperacao">Palestra de
                                                    recuperação</label>
                                            </div>
                                        </div>
                                        <div class="col-12 row">
                                            <h4 class="">BI que publicou: </h4>
                                            <h5 class="col-1 font-small">BI Nº: </h5>
                                            <div class="col-3">
                                                {!! Form::number('acidentes_atividades_militares_numero_bi', $ficha->getNumeroBiAtividadesMilitares(), [
                                                    'placeholder' => 'Ex: 10',
                                                    'class' => 'form-control font-small',
                                                    'min' => 1,
                                                ]) !!}
                                            </div>
                                            <h5 class="col-2 font-small text-center"> do dia </h5>
                                            <div class="col-4">
                                                {!! Form::date('acidentes_atividades_militares_data_bi', $ficha->getDataBiAtividadesMilitares(), ['class' => 'form-control font-small']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-8 margin-bottom-25">
                                    <div class="row justify-content-center">
                                        <div class="col-12 row">
                                            <h4 class=""><b>Assistiu à Palestra de Prevenção de Acidentes
                                                    Automobilísticos?</b> </h4>
                                        </div>
                                        <div class="col-12 row justify-content-center">
                                            <div class="col-4">
                                                <input class="form-check-input font-small" type="radio"
                                                    name="acidentes_automobilisticos" id="acidentes_automobilisticos_sim"
                                                    value="1" @if ($ficha->acidentes_automobilisticos == '1') checked @endif>
                                                <label class="form-check-label font-small"
                                                    for="acidentes_automobilisticos_sim">Sim</label>
                                            </div>
                                            <div class="col-4">
                                                <input class="form-check-input font-small" type="radio"
                                                    name="acidentes_automobilisticos" id="acidentes_automobilisticos_nao"
                                                    value="2" @if ($ficha->acidentes_automobilisticos == '2') checked @endif>
                                                <label class="form-check-label font-small"
                                                    for="acidentes_automobilisticos_nao">Não</label>
                                            </div>
                                            <div class="col-4">
                                                <input class="form-check-input font-small" type="radio"
                                                    name="acidentes_automobilisticos"
                                                    id="acidentes_automobilisticos_recuperacao" value="3"
                                                    @if ($ficha->acidentes_automobilisticos == '3') checked @endif>
                                                <label class="form-check-label font-small"
                                                    for="acidentes_automobilisticos_recuperacao">Palestra de
                                                    recuperação</label>
                                            </div>
                                        </div>
                                        <div class="col-12 row">
                                            <h4 class="">BI que publicou: </h4>
                                            <h5 class="col-1 font-small">BI Nº </h5>
                                            <div class="col-3">
                                                {!! Form::number('acidentes_automobilisticos_numero_bi', $ficha->getNumeroBiAutomobilisticos(), [
                                                    'placeholder' => 'Ex: 10',
                                                    'class' => 'form-control font-small',
                                                    'min' => 1,
                                                ]) !!}
                                            </div>
                                            <h5 class="col-2 font-small text-center"> do dia </h5>
                                            <div class="col-4">
                                                {!! Form::date('acidentes_automobilisticos_data_bi', $ficha->getDataBiAutomobilisticos(), ['class' => 'form-control font-small']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-8 margin-bottom-25">
                                    <div class="row justify-content-center">
                                        <div class="col-12 row">
                                            <h4 class=""><b>Possui Carteira Nacional de Habilitação?</b></h4>
                                        </div>
                                        <div class="col-12 row justify-content-center">
                                            <div class="col-2">
                                                <input class="form-check-input font-small" type="radio"
                                                    name="possui_cnh" id="possui_cnh_sim" value="1" @if ($ficha->possui_cnh == '1') checked @endif>
                                                <label class="form-check-label font-small"
                                                    for="possui_cnh_sim">Sim</label>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input font-small" type="radio"
                                                    name="possui_cnh" id="possui_cnh_nao" value="2" @if ($ficha->possui_cnh == '2') checked @endif>
                                                <label class="form-check-label font-small"
                                                    for="possui_cnh_nao">Não</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-8 margin-bottom-25">
                                    <div class="row justify-content-center">
                                        <div class="col-12 row">
                                            <h4 class=""><b>Se Categoria A, realizou o Estágio de Prevenção de
                                                    Acidentes
                                                    Motociclísticos?</b></h4>
                                        </div>
                                        <div class="col-12 row justify-content-center">
                                            <div class="col-4">
                                                <input class="form-check-input font-small" type="radio"
                                                    name="acidentes_motociclisticos" id="acidentes_motociclisticos_sim"
                                                    value="1" @if ($ficha->acidentes_motociclisticos == '1') checked @endif>
                                                <label class="form-check-label font-small"
                                                    for="acidentes_motociclisticos_sim">Sim</label>
                                            </div>
                                            <div class="col-4">
                                                <input class="form-check-input font-small" type="radio"
                                                    name="acidentes_motociclisticos" id="acidentes_motociclisticos_nao"
                                                    value="2" @if ($ficha->acidentes_motociclisticos == '2') checked @endif>
                                                <label class="form-check-label font-small"
                                                    for="acidentes_motociclisticos_nao">Não</label>
                                            </div>
                                            <div class="col-4">
                                                <input class="form-check-input font-small" type="radio"
                                                    name="acidentes_motociclisticos"
                                                    id="acidentes_motociclisticos_recuperacao" value="3" @if ($ficha->acidentes_motociclisticos == '3') checked @endif>
                                                <label class="form-check-label font-small"
                                                    for="acidentes_motociclisticos_recuperacao">Palestra de
                                                    recuperação</label>
                                            </div>
                                        </div>
                                        <div class="col-12 row">
                                            <h4 class="">BI que publicou: </h4>
                                            <h5 class="col-1 font-small">BI Nº </h5>
                                            <div class="col-3">
                                                {!! Form::number('acidentes_motociclisticos_numero_bi', $ficha->getNumeroBiMotociclisticos(), [
                                                    'placeholder' => 'Ex: 10',
                                                    'class' => 'form-control font-small',
                                                    'min' => 1,
                                                ]) !!}
                                            </div>
                                            <h5 class="col-2 font-small text-center"> do dia </h5>
                                            <div class="col-4">
                                                {!! Form::date('acidentes_motociclisticos_data_bi', $ficha->getDataBiMotociclisticos(), ['class' => 'form-control font-small']) !!}
                                            </div>
                                        </div>
                                        <div class="col-12 row">
                                            <h4 class="">Como foi classificada a perícia na condução de motocicleta?
                                            </h4>
                                        </div>
                                        <div class="col-12 row justify-content-center">
                                            <div class="col-2">
                                                <input class="form-check-input font-small" type="radio"
                                                    name="conducao_motocicleta" id="conducao_motocicleta_e"
                                                    value="E" @if ($ficha->conducao_motocicleta == 'E') checked @endif>
                                                <label class="form-check-label font-small"
                                                    for="conducao_motocicleta_e">E</label>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input font-small" type="radio"
                                                    name="conducao_motocicleta" id="conducao_motocicleta_mb"
                                                    value="MB" @if ($ficha->conducao_motocicleta == 'MB') checked @endif>
                                                <label class="form-check-label font-small"
                                                    for="conducao_motocicleta_mb">MB</label>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input font-small" type="radio"
                                                    name="conducao_motocicleta" id="conducao_motocicleta_b"
                                                    value="B" @if ($ficha->conducao_motocicleta == 'B') checked @endif>
                                                <label class="form-check-label font-small"
                                                    for="conducao_motocicleta_b">B</label>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input font-small" type="radio"
                                                    name="conducao_motocicleta" id="conducao_motocicleta_r"
                                                    value="R" @if ($ficha->conducao_motocicleta == 'R') checked @endif>
                                                <label class="form-check-label font-small"
                                                    for="conducao_motocicleta_r">R</label>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input font-small" type="radio"
                                                    name="conducao_motocicleta" id="conducao_motocicleta_i"
                                                    value="I" @if ($ficha->conducao_motocicleta == 'I') checked @endif>
                                                <label class="form-check-label font-small"
                                                    for="conducao_motocicleta_i">I</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="first-form">
                <button type="button" class="offset-9 col-3 btn btn-white" id="proximo">Continuar preenchendo</button>
            </div>

            <div class="row d-none" id="second-form">
                <button type="button" class="col-3 btn btn-danger" id="anterior">Anterior</button>
                <button class="offset-6 col-3 btn btn-primary" type="submit" id="concluir">Concluir</button>
            </div>
        </div>
        <input type="text" class="d-none" name="ficha_id" value="{{$ficha->id}}">
        {!! Form::close() !!}
    </div>
    </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#proximo').on("click", function() {
                $('#dados-familiares').addClass('d-none');
                $('#instrucoes').removeClass('d-none');
                $('#first-form').addClass('d-none');
                $('#second-form').removeClass('d-none');
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
