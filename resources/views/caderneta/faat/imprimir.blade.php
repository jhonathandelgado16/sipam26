@extends('layouts.gerar_pdf')

@section('content')
    <table>
        <thead>
            <th colspan="3">
                Ficha de Avaliação de Atributos
            </th>
        </thead>
        <tbody>
            <tr>
                <td>Nº: {{ $militar->numero }}</td>
                <td colspan="2">Nome: {{ $militar->nome }}</td>
            </tr>
            <tr>
                <td>OM: 26º GAC</td>
                <td>SU: {{ $militar->subunidade->nome }}</td>
                <td>Fração: {{ $militar->pelotao->pelotao }}</td>
            </tr>
        </tbody>
    </table>


    @if (!empty($militar->getInformacoesFaat()))
        <div class="div-oii col-12 row">

            <div class="col-12">
                <table class="">
                    <thead>
                        <th colspan="4">Atributos</th>
                    </thead>
                    <thead>
                        <th rowspan="2">Identificação</th>
                        <th colspan="3">Padrão Mínimo</th>
                    </thead>
                    <thead>
                        <th>Sim</th>
                        <th>Não</th>
                        <th>Não Observado</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>COOPERAÇÃO</td>
                            <td>
                                @if ($militar->getInformacoesFaat()->cooperacao == 1)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->cooperacao == 0)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->cooperacao == 2)
                                    X
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>AUTOCONFIANÇA</td>
                            <td>
                                @if ($militar->getInformacoesFaat()->autoconfianca == 1)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->autoconfianca == 0)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->autoconfianca == 2)
                                    X
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>PERSISTÊNCIA</td>
                            <td>
                                @if ($militar->getInformacoesFaat()->persistencia == 1)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->persistencia == 0)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->persistencia == 2)
                                    X
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>INICIATIVA</td>
                            <td>
                                @if ($militar->getInformacoesFaat()->iniciativa == 1)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->iniciativa == 0)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->iniciativa == 2)
                                    X
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>CORAGEM</td>
                            <td>
                                @if ($militar->getInformacoesFaat()->coragem == 1)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->coragem == 0)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->coragem == 2)
                                    X
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>RESPONSABILIDADE</td>
                            <td>
                                @if ($militar->getInformacoesFaat()->responsabilidade == 1)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->responsabilidade == 0)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->responsabilidade == 2)
                                    X
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>DISCIPLINA</td>
                            <td>
                                @if ($militar->getInformacoesFaat()->disciplina == 1)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->disciplina == 0)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->disciplina == 2)
                                    X
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>EQUILÍBRIO EMOCIONAL</td>
                            <td>
                                @if ($militar->getInformacoesFaat()->equilibrio_emocional == 1)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->equilibrio_emocional == 0)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->equilibrio_emocional == 2)
                                    X
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>ENTUSIASMO PROFISSIONAL</td>
                            <td>
                                @if ($militar->getInformacoesFaat()->entusiasmo_profissional == 1)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->entusiasmo_profissional == 0)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->entusiasmo_profissional == 2)
                                    X
                                @endif
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <br>
            <div class="col-12">
                <table class="">
                    <thead>
                        <th colspan="3">APRECIAÇÃO FINAL DO PERÍODO</th>
                    </thead>
                        <th></th>
                        <th class="td-apreciacao">Sim</th>
                        <th class="td-apreciacao">Não</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Pode ser matriculado no Curso de Formação de Cabos?
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->matricula_cfc == 1)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->matricula_cfc == 0)
                                    X
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Foi punido durante a fase?
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->punicao_fase == 1)
                                    X
                                @endif
                            </td>
                            <td>
                                @if ($militar->getInformacoesFaat()->punicao_fase == 0)
                                    X
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <div class="col-12">
                <table class="">
                    <thead>
                        <th rowspan="2">Avaliação Global Subjetiva</th>
                        <th>MB</th>
                        <th>B</th>
                        <th>R</th>
                        <th>I</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="td-avaliacao">
                                @if ($militar->getInformacoesFaat()->avaliacao_global == 'MB')
                                    X
                                @endif
                            </td>
                            <td class="td-avaliacao">
                                @if ($militar->getInformacoesFaat()->avaliacao_global == 'B')
                                    X
                                @endif
                            </td>
                            <td class="td-avaliacao">
                                @if ($militar->getInformacoesFaat()->avaliacao_global == 'R')
                                    X
                                @endif
                            </td>
                            <td class="td-avaliacao">
                                @if ($militar->getInformacoesFaat()->avaliacao_global == 'I')
                                    X
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br>
    @else
        <table>
            <tr>
                <td>O militar não possui informações da FAAT</td>
            </tr>
        </table>
    @endif

    <br>
    <div class="row col-12">
        <table class="footer-table">
            <tr>
                <td>Responsável pelo preenchimento: {{ $militar->getOperador()->name }}</td>
                <td>Visto do Cmt SU: _____________________________</td>
            </tr>
        </table>
    </div>

@endsection
