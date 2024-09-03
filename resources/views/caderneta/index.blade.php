@extends('layouts.app')

@section('content')


    <div class="row margin-bottom-15">
        <div class="pull-right col-8">
            <a class="btn btn-white" href="{{ route('militares.index') }}"><img src="{{ url('storage/icons/back.png') }}"
                    height="20"> Voltar</a>
        </div>
    </div>

    <div class="row margin-bottom-10">
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <h2 class="title-caderneta">Caderneta do Cmt de Pelotão</h2>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 row margin-bottom-10">
            <div class="row card-fo">
                <div class="col-2 row justify-content-center">
                    <img class="col-md-8" src="{{ url('storage/caveira.png') }}">
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

        <div class="col-12 row margin-bottom-10">
            <div class="row title-caderneta">
                <h2 class="col-9">Fatos Observados</h2>
                <a class=" col-3 btn btn-caderneta" href="{{ route('fo.inserir', $militar->id) }}">Cadastrar novo FO</a>
            </div>
            @if ($fatos->isNotEmpty())
                @foreach ($fatos as $key => $fato)
                    <div class="row card-fo">
                        <div class="col-12 row">
                            <h3 class="col-2 text-center">{{ $fato->fato_observado }}</h3>
                            <h3 class="offset-7 col-3 text-center">{{ $fato->getDataFormatada() }}</h3>
                        </div>
                        <div class="row">
                            <h4 class="col-12 text-center">
                                {{ $fato->descricao }}
                            </h4>
                        </div>
                        <div class="row">
                            <h3 class="offset-6 col-6 text-center"> {{ $fato->militar_que_observou }}</h3>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row card-fo">
                    <div class="col-12 row">
                        <h4 class="col-12 text-center">
                            O militar não possui nenhum fato observado
                        </h4>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-12 row margin-bottom-10">
            <div class="row title-caderneta">
                <h2 class="col-9">Observações</h2>
                <a class=" col-3 btn btn-caderneta" href="{{ route('obs.inserir', $militar->id) }}">Cadastrar nova
                    observação</a>
            </div>

            @if ($observacoes->isNotEmpty())
                @foreach ($observacoes as $key => $observacao)
                    <div class="row card-fo">
                        <div class="col-12 row">
                            <h3 class="offset-9 col-3 text-center">{{ $observacao->getDataFormatada() }}</h3>
                        </div>
                        <div class="row">
                            <h4 class="col-12 text-center">
                                {{ $observacao->observacao }}
                            </h4>
                        </div>
                        <div class="row">
                            <h3 class="offset-6 col-6 text-center">{{ $fato->militar_que_observou }}</h3>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row card-fo">
                    <div class="col-12 row">
                        <h4 class="col-12 text-center">
                            O militar não possui nenhuma observação
                        </h4>
                    </div>
                </div>
            @endif

        </div>

        <div class="col-12 row margin-bottom-10">
            <div class="row title-caderneta">
                <h2 class="col-9">Visitas Médicas</h2>
                <a class=" col-3 btn btn-caderneta" href="{{ route('visita_medica.inserir', $militar->id) }}">Cadastrar
                    nova visita médica</a>
            </div>
            @if ($visitas_medicas->isNotEmpty())
                @foreach ($visitas_medicas as $key => $visita_medica)
                    <div class="row card-fo">
                        <div class="col-12 row">
                            <h3 class="col-6 text-center">{{ $visita_medica->medico->getMedico() }}</h3>
                            <h3 class="offset-3 col-3 text-center">{{ $visita_medica->getDataFormatada() }}</h3>
                        </div>
                        <div class="row">
                            <h4 class="col-12 text-center">
                                {{ $visita_medica->descricao }}
                            </h4>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row card-fo">
                    <div class="col-12 row">
                        <h4 class="col-12 text-center">
                            O militar não possui nenhuma visita médica
                        </h4>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-12 row margin-bottom-10">
            <div class="row title-caderneta">
                <h2 class="col-9">Vacinas aplicadas</h2>
                <a class=" col-3 btn btn-caderneta" href="{{ route('vacina_aplicada.inserir', $militar->id) }}">Cadastrar
                    nova vacina aplicada</a>
            </div>
            @if ($vacinas_aplicadas->isNotEmpty())
                @foreach ($vacinas_aplicadas as $key => $vacina_aplicada)
                    <div class="row card-fo">
                        <div class="col-12 row">
                            <h3 class="offset-9 col-3 text-center">{{ $vacina_aplicada->getDataFormatada() }}</h3>
                        </div>
                        <div class="row">
                            <h4 class="col-12 text-center">
                                {{ $vacina_aplicada->vacina->vacina }}
                            </h4>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row card-fo">
                    <div class="col-12 row">
                        <h4 class="col-12 text-center">
                            O militar não possui nenhuma vacina aplicada
                        </h4>
                    </div>
                </div>
            @endif
        </div>


        @if ($militar->posto->posto == 'Sd Ev')

        <div class="col-12 row margin-bottom-10">
            <div class="row title-caderneta">
                <h2 class="col-9">Ficha da Instrução Individual Básica</h2>
                @if (!$militar->possuiFiibPreenchida())
                    <a class=" col-3 btn btn-caderneta" href="{{ route('fiib.preencher', $militar->id) }}">Preencher
                        FIIB</a>
                @else
                    <a target="_blank" class="col-3 btn btn-caderneta" href="{{ route('fiib.pdf', $militar->id) }}">Gerar
                        PDF FIIB</a>
                @endif
            </div>

            @if ($resultados_fiib->isNotEmpty())
                @php
                    $valor_chunk = 1;
                    if (count($resultados_fiib) > 5) {
                        $valor_chunk = ceil(count($resultados_fiib) / 5);
                    }
                    $grupoResultados = $resultados_fiib->chunk($valor_chunk);
                @endphp

                @foreach ($grupoResultados as $grupo)
                    <div class="col font-small">
                        <div class="row item-oii text-center fiib-thead">
                            <div class="col-5">Identificação</div>
                            <div class="col-7">
                                Padrão Mínimo
                            </div>
                        </div>

                        @foreach ($grupo as $key => $resultado)
                            <div class="row item-oii text-center">
                                <div class="col-5">{{ $resultado->objetivo_instrucao->getOII() }}</div>
                                <div class="col-7 text-center">
                                    @if ($resultado->padrao_minimo_atingido == 1)
                                        <b class="color-green">
                                            <ion-icon name="checkmark-circle"></ion-icon>
                                        </b>
                                    @else
                                        <b class="color-red">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </b>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @else
                <div class="row card-fo">
                    <div class="col-12 row">
                        <h4 class="col-12 text-center">
                            O militar não possui informações da FIIB
                        </h4>
                    </div>
                </div>
            @endif

        </div>

        @if ($militar->qualificacao_militar->qualificacao != 'RECRUTA')        
        <div class="col-12 row margin-bottom-10">
            <div class="row title-caderneta">
                <h2 class="col-8">Ficha da Instrução Individual de Qualificação</h2>
                    <a class="col-2 btn btn-caderneta" href="{{ route('fiiq.preencher', $militar->id) }}">Preencher
                        FIIQ</a>
                    <a target="_blank" class="col-2 btn btn-caderneta" href="{{ route('fiiq.pdf', $militar->id) }}">Gerar
                        PDF FIIQ</a>
            </div>

            @if ($resultados_fiiq->isNotEmpty())
                @php
                    $valor_chunk = 1;
                    if (count($resultados_fiiq) > 5) {
                        $valor_chunk = ceil(count($resultados_fiiq) / 5);
                    }
                    $grupoResultados = $resultados_fiiq->chunk($valor_chunk);
                @endphp

                @foreach ($grupoResultados as $grupo)
                    <div class="col font-small">
                        <div class="row item-oii text-center fiib-thead">
                            <div class="col-5">Identificação</div>
                            <div class="col-7">
                                Padrão Mínimo
                            </div>
                        </div>

                        @foreach ($grupo as $key => $resultado)
                            <div class="row item-oii text-center">
                                <div class="col-5">{{ $resultado->objetivo_instrucao->getOII() }}</div>
                                <div class="col-7 text-center">
                                    @if ($resultado->padrao_minimo_atingido == 1)
                                        <b class="color-green">
                                            <ion-icon name="checkmark-circle"></ion-icon>
                                        </b>
                                    @else
                                        <b class="color-red">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </b>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @else
                <div class="row card-fo">
                    <div class="col-12 row">
                        <h4 class="col-12 text-center">
                            O militar não possui informações da FIIQ
                        </h4>
                    </div>
                </div>
            @endif

        </div>
    
    @endif

        <div class="col-12 row margin-bottom-10">
            <div class="row title-caderneta">
                <h2 class="col-9">Ficha de Avaliação de Atributos</h2>
                @if (!$militar->possuiFaatPreenchida())
                    <a class=" col-3 btn btn-caderneta" href="{{ route('faat.preencher', $militar->id) }}">Preencher
                        FAAT</a>
                @else
                    <a target="_blank" class="col-3 btn btn-caderneta"
                        href="{{ route('faat.pdf', $militar->id) }}">Gerar PDF FAAT</a>
                @endif
            </div>

            @if (!(empty($faat)))
                <div class="row col-6">
                    <div class="row item-oii text-center fiib-thead font-x-small">
                        <div class="col-6">Identificação</div>
                        <div class="col-6">Padrão Evidenciado</div>
                    </div>

                        <div class="row item-oii text-center justify-content-center font-x-small">
                            <div class="col-6">COOPERAÇÃO</div>
                            <div class="col-6 row">
                                <div class="col row">
                                    <input type="radio" value="1" class="btn-check"
                                        name="cooperacao" id="option1-cooperacao"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->cooperacao == 1) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option1-cooperacao">Sim</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="0" class="btn-check col"
                                        name="cooperacao" id="option0-cooperacao"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->cooperacao == 0) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option0-cooperacao">Não</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="2" class="btn-check col"
                                        name="cooperacao" id="option2-cooperacao"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->cooperacao == 2) checked @endif disabled>
                                    <label class="btn radio-check font-x-small" for="option2-cooperacao">Não
                                        Obs</label>
                                </div>
                            </div>
                        </div>

                        <div class="row item-oii text-center justify-content-center font-x-small">
                            <div class="col-6">AUTOCONFIANÇA</div>
                            <div class="col-6 row">
                                <div class="col row">
                                    <input type="radio" value="1" class="btn-check"
                                        name="autoconfianca" id="option1-autoconfianca"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->autoconfianca == 1) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option1-autoconfianca">Sim</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="0" class="btn-check col"
                                        name="autoconfianca" id="option0-autoconfianca"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->autoconfianca == 0) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option0-autoconfianca">Não</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="2" class="btn-check col"
                                        name="autoconfianca" id="option2-autoconfianca"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->autoconfianca == 2) checked @endif disabled>
                                    <label class="btn radio-check font-x-small" for="option2-autoconfianca">Não
                                        Obs</label>
                                </div>
                            </div>
                        </div>

                        <div class="row item-oii text-center justify-content-center font-x-small">
                            <div class="col-6">PERSISTÊNCIA</div>
                            <div class="col-6 row">
                                <div class="col row">
                                    <input type="radio" value="1" class="btn-check"
                                        name="persistencia" id="option1-persistencia"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->persistencia == 1) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option1-persistencia">Sim</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="0" class="btn-check col"
                                        name="persistencia" id="option0-persistencia"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->persistencia == 0) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option0-persistencia">Não</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="2" class="btn-check col"
                                        name="persistencia" id="option2-persistencia"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->persistencia == 2) checked @endif disabled>
                                    <label class="btn radio-check font-x-small" for="option2-persistencia">Não
                                        Obs</label>
                                </div>
                            </div>
                        </div>

                        <div class="row item-oii text-center justify-content-center font-x-small">
                            <div class="col-6">INICIATIVA</div>
                            <div class="col-6 row">
                                <div class="col row">
                                    <input type="radio" value="1" class="btn-check"
                                        name="iniciativa" id="option1-iniciativa"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->iniciativa == 1) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option1-iniciativa">Sim</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="0" class="btn-check col"
                                        name="iniciativa" id="option0-iniciativa"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->iniciativa == 0) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option0-iniciativa">Não</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="2" class="btn-check col"
                                        name="iniciativa" id="option2-iniciativa"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->iniciativa == 2) checked @endif disabled>
                                    <label class="btn radio-check font-x-small" for="option2-iniciativa">Não
                                        Obs</label>
                                </div>
                            </div>
                        </div>

                        <div class="row item-oii text-center justify-content-center font-x-small">
                            <div class="col-6">CORAGEM</div>
                            <div class="col-6 row">
                                <div class="col row">
                                    <input type="radio" value="1" class="btn-check"
                                        name="coragem" id="option1-coragem"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->coragem == 1) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option1-coragem">Sim</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="0" class="btn-check col"
                                        name="coragem" id="option0-coragem"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->coragem == 0) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option0-coragem">Não</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="2" class="btn-check col"
                                        name="coragem" id="option2-coragem"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->coragem == 2) checked @endif disabled>
                                    <label class="btn radio-check font-x-small" for="option2-coragem">Não
                                        Obs</label>
                                </div>
                            </div>
                        </div>

                        <div class="row item-oii text-center justify-content-center font-x-small">
                            <div class="col-6">RESPONSABILIDADE</div>
                            <div class="col-6 row">
                                <div class="col row">
                                    <input type="radio" value="1" class="btn-check"
                                        name="responsabilidade" id="option1-responsabilidade"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->responsabilidade == 1) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option1-responsabilidade">Sim</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="0" class="btn-check col"
                                        name="responsabilidade" id="option0-responsabilidade"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->responsabilidade == 0) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option0-responsabilidade">Não</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="2" class="btn-check col"
                                        name="responsabilidade" id="option2-responsabilidade"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->responsabilidade == 2) checked @endif disabled>
                                    <label class="btn radio-check font-x-small" for="option2-responsabilidade">Não
                                        Obs</label>
                                </div>
                            </div>
                        </div>

                        <div class="row item-oii text-center justify-content-center font-x-small">
                            <div class="col-6">DISCIPLINA</div>
                            <div class="col-6 row">
                                <div class="col row">
                                    <input type="radio" value="1" class="btn-check"
                                        name="disciplina" id="option1-disciplina"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->disciplina == 1) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option1-disciplina">Sim</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="0" class="btn-check col"
                                        name="disciplina" id="option0-disciplina"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->disciplina == 0) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option0-disciplina">Não</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="2" class="btn-check col"
                                        name="disciplina" id="option2-disciplina"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->disciplina == 2) checked @endif disabled>
                                    <label class="btn radio-check font-x-small" for="option2-disciplina">Não
                                        Obs</label>
                                </div>
                            </div>
                        </div>

                        <div class="row item-oii text-center justify-content-center font-x-small">
                            <div class="col-6">EQUILÍBRIO EMOCIONAL</div>
                            <div class="col-6 row">
                                <div class="col row">
                                    <input type="radio" value="1" class="btn-check"
                                        name="equilibrio_emocional" id="option1-equilibrio_emocional"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->equilibrio_emocional == 1) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option1-equilibrio_emocional">Sim</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="0" class="btn-check col"
                                        name="equilibrio_emocional" id="option0-equilibrio_emocional"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->equilibrio_emocional == 0) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option0-equilibrio_emocional">Não</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="2" class="btn-check col"
                                        name="equilibrio_emocional" id="option2-equilibrio_emocional"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->equilibrio_emocional == 2) checked @endif disabled>
                                    <label class="btn radio-check font-x-small" for="option2-equilibrio_emocional">Não
                                        Obs</label>
                                </div>
                            </div>
                        </div>

                        <div class="row item-oii text-center justify-content-center font-x-small">
                            <div class="col-6">ENTUSIASMO PROFISSIONAL</div>
                            <div class="col-6 row">
                                <div class="col row">
                                    <input type="radio" value="1" class="btn-check"
                                        name="entusiasmo_profissional" id="option1-entusiasmo_profissional"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->entusiasmo_profissional == 1) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option1-entusiasmo_profissional">Sim</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="0" class="btn-check col"
                                        name="entusiasmo_profissional" id="option0-entusiasmo_profissional"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->entusiasmo_profissional == 0) checked @endif disabled>
                                    <label class="btn radio-check font-x-small"
                                        for="option0-entusiasmo_profissional">Não</label>
                                </div>
                                <div class="col row">
                                    <input type="radio" value="2" class="btn-check col"
                                        name="entusiasmo_profissional" id="option2-entusiasmo_profissional"
                                        autocomplete="off" @if ($militar->getInformacoesFaat()->entusiasmo_profissional == 2) checked @endif disabled>
                                    <label class="btn radio-check font-x-small" for="option2-entusiasmo_profissional">Não
                                        Obs</label>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="col-6">
                    <div class="row item-oii text-center fiib-thead font-medium">
                        <div class="col-12">Apreciação Final do Período</div>
                    </div>

                    <div class="row item-oii text-center justify-content-center font-x-small">
                        <div class="col-6">PODE SER MATRICULADO NO CURSO DE CABO?</div>
                        <div class="col-6 row">
                            <div class="col row">
                                <input type="radio" value="1" class="btn-check" name="matricula_cfc"
                                    id="option1-matricula" @if ($militar->getInformacoesFaat()->matricula_cfc == 1) checked @endif autocomplete="off" disabled>
                                <label class="btn radio-check font-x-small" for="option1-matricula">Sim</label>
                            </div>
                            <div class="col row">
                                <input type="radio" value="0" class="btn-check col" name="matricula_cfc"
                                    id="option0-matricula" @if ($militar->getInformacoesFaat()->matricula_cfc == 0) checked @endif autocomplete="off" disabled>
                                <label class="btn radio-check font-x-small" for="option0-matricula">Não</label>
                            </div>
                        </div>
                    </div>

                    <div class="row item-oii text-center justify-content-center font-x-small">
                        <div class="col-6">FOI PUNIDO DURANTE A FASE?</div>
                        <div class="col-6 row">
                            <div class="col row">
                                <input type="radio" value="1" class="btn-check" name="punicao_fase"
                                    id="option1-punicao" @if ($militar->getInformacoesFaat()->punicao_fase == 1) checked @endif autocomplete="off" disabled>
                                <label class="btn radio-check font-x-small" for="option1-punicao">Sim</label>
                            </div>
                            <div class="col row">
                                <input type="radio" value="0" class="btn-check col" name="punicao_fase"
                                    id="option0-punicao" @if ($militar->getInformacoesFaat()->punicao_fase == 0) checked @endif autocomplete="off" disabled>
                                <label class="btn radio-check font-x-small" for="option0-punicao">Não</label>
                            </div>
                        </div>
                    </div>

                    <div class="row item-oii text-center fiib-thead font-medium">
                        <div class="col-12">Avaliação Global Subjetiva</div>
                    </div>

                    <div class="row item-oii text-center justify-content-center font-x-small">
                        <div class="col-12 row">
                            <div class="col row">
                                <input type="radio" value="MB" class="btn-check" name="avaliacao_global"
                                    id="option-mb-avaliacao" autocomplete="off" @if ($militar->getInformacoesFaat()->avaliacao_global == 'MB') checked @endif disabled>
                                <label class="btn radio-check font-x-small" for="option-mb-avaliacao">MUITO BOM</label>
                            </div>
                            <div class="col row">
                                <input type="radio" value="B" class="btn-check col" name="avaliacao_global"
                                    id="option-b-avaliacao" autocomplete="off" @if ($militar->getInformacoesFaat()->avaliacao_global == 'B') checked @endif disabled>
                                <label class="btn radio-check font-x-small" for="option-b-avaliacao">BOM</label>
                            </div>
                            <div class="col row">
                                <input type="radio" value="R" class="btn-check col" name="avaliacao_global"
                                    id="option-r-avaliacao" autocomplete="off" @if ($militar->getInformacoesFaat()->avaliacao_global == 'R') checked @endif disabled>
                                <label class="btn radio-check font-x-small" for="option-r-avaliacao">REGULAR</label>
                            </div>
                            <div class="col row">
                                <input type="radio" value="I" class="btn-check col" name="avaliacao_global"
                                    id="option-i-avaliacao" autocomplete="off" @if ($militar->getInformacoesFaat()->avaliacao_global == 'I') checked @endif disabled>
                                <label class="btn radio-check font-x-small" for="option-i-avaliacao">INSUFICIENTE</label>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row card-fo">
                    <div class="col-12 row">
                        <h4 class="col-12 text-center">
                            O militar não possui informações da Ficha de Avaliação de Atributos
                        </h4>
                    </div>
                </div>
            @endif
        </div>
        @endif
    </div>

    </div>
@endsection
