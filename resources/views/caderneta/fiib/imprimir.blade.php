@extends('layouts.gerar_pdf')

@section('content')
    <table>
        <thead>
            <th colspan="3">
                Ficha da Instrução Individual Básica
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

    <div class="div-oii col-12 row">

        @if ($militar->getInformacoesFiib()->isNotEmpty())
            @php
                $valor_chunk = 1;
                if (count($militar->getInformacoesFiib()) > 5) {
                    $valor_chunk = ceil(count($militar->getInformacoesFiib()) / 5);
                }
                $grupoResultados = $militar->getInformacoesFiib()->chunk($valor_chunk);
            @endphp

            @foreach ($grupoResultados as $grupo)
                <div class="col-2">
                    <table class="table-oii">
                        <thead>
                            <th colspan="3">OII</th>
                        </thead>
                        <thead>
                            <th rowspan="2">Identificação</th>
                            <th colspan="2">Padrão Mínimo</th>
                        </thead>
                        <thead>
                            <th>Sim</th>
                            <th>Não</th>
                        </thead>
                        <tbody>
                            @foreach ($grupo as $key => $resultado)
                                <tr>
                                    <td>{{ $resultado->objetivo_instrucao->getOII() }}</td>
                                    @if ($resultado->padrao_minimo_atingido == 1)
                                        <td>X</td>
                                        <td></td>
                                    @else
                                        <td></td>
                                        <td>X</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        @else
            <table>
                <tr>
                    <td>O militar não possui informações da FIIB</td>
                </tr>
            </table>
        @endif

    </div>
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
