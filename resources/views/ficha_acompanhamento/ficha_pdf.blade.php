@extends('layouts.gerar_pdf')

@section('content')
    <div class="grid-container">
        <div class="grid-item-1">
            <table class="footer-table">
                <tr>
                    <td>
                        _____________________________
                        <br>
                        Visto do Cmt Fração
                    </td>
                    <td>
                        _____________________________
                        <br>
                        Visto do Cmt Pelotão
                    </td>
                </tr>
            </table>
            <br>

            <h3 class="text-center h3-ficha">FICHA DE ACOMPANHAMENTO DE MILITAR</h3>
            <table class="table-acompanhamento">
                <tbody>
                    <tr>
                        <td><b>OM:</b></td>
                        <td class="text-align-right">26º GAC</td>
                    </tr>
                    <tr>
                        <td><b>SU:</b> </td>
                        <td class="text-align-right">{{ $militar->subunidade->nome }}</td>
                    </tr>
                    <tr>
                        <td><b>Fração:</b> </td>
                        <td class="text-align-right">{{ $militar->pelotao->pelotao }}</td>
                    </tr>
                    <tr>
                        <td><b>Nome Cmt/Ch:</b> </td>
                        <td class="text-align-right">{{ $militar->pelotao->cmt_pelotao }}</td>
                    </tr>
                </tbody>
            </table>

            <br>

            <h3 class="text-center h3-ficha">DADOS DO MILITAR</h3>
            <table class="table-acompanhamento">
                <tbody>
                    <tr>
                        <td><b>(P/G) NOME:</b></td>
                        <td class="text-align-right">{{ $militar->getMilitar() }}</td>
                    </tr>
                    <tr>
                        <td><b>Nome Completo:</b> </td>
                        <td class="text-align-right">{{ $militar->nome }}</td>
                    </tr>
                    <tr>
                        <td><b>Nr Identidade:</b> </td>
                        <td class="text-align-right">{{ $militar->idt_militar }}</td>
                    </tr>
                    <tr>
                        <td><b>Ano de Incorporação:</b> </td>
                        <td class="text-align-right">{{ $militar->turma }}</td>
                    </tr>
                    <tr>
                        <td><b>Nr Telefone:</b> </td>
                        <td class="text-align-right">{{ $militar->contato }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Endereço Residencial:</b> </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-align-right">{{ $militar->endereco }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Se casado, dados da esposa:</b> </td>
                    </tr>
                    <tr>
                        <td><b>Nome:</b> </td>
                        <td class="text-align-right">
                            @if ($ficha_acompanhamento->nome_esposa != null)
                                {{ $ficha_acompanhamento->nome_esposa }}
                            @else
                                ________________________________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><b>Nr Telefone:</b> </td>
                        <td class="text-align-right">
                            @if ($ficha_acompanhamento->contato_esposa != null)
                                {{ $ficha_acompanhamento->contato_esposa }}
                            @else
                                ________________________________________
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            <br>

            <h3 class="text-center h3-ficha">DADOS FAMILIARES</h3>
            <table class="table-acompanhamento">
                <tbody>
                    <tr>
                        <td><b>Nome do pai/responsável:</b> </td>
                        <td class="text-align-right">
                            @if ($ficha_acompanhamento->nome_pai != null)
                                {{ $ficha_acompanhamento->nome_pai }}
                            @else
                                ________________________________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><b>Nr Telefone:</b> </td>
                        <td class="text-align-right">
                            @if ($ficha_acompanhamento->contato_pai != null)
                                {{ $ficha_acompanhamento->contato_pai }}
                            @else
                                ________________________________________
                            @endif
                        </td>
                    </tr>
                    <br>
                    <tr>
                        <td><b>Nome da mãe/responsável:</b> </td>
                        <td class="text-align-right">
                            @if ($ficha_acompanhamento->nome_mae != null)
                                {{ $ficha_acompanhamento->nome_mae }}
                            @else
                                ________________________________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><b>Nr Telefone:</b> </td>
                        <td class="text-align-right">
                            @if ($ficha_acompanhamento->contato_mae != null)
                                {{ $ficha_acompanhamento->contato_mae }}
                            @else
                                ________________________________________
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="grid-item-2">

            <table class="table-palestras">
                <tbody>
                    <tr>
                        <td colspan="7"><b>Assistiu à Palestra de Prevenção de Acidentes nas Atividades Militares?</b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="td-5">
                            @if ($ficha_acompanhamento->acidentes_atividades_militares == '1')
                                <div class="check"></div>
                            @else
                                <div class="uncheck"></div>
                            @endif
                        </td>
                        <td class="td-15 text-left"> Sim</td>

                        <td class="td-5">
                            @if ($ficha_acompanhamento->acidentes_atividades_militares == '2')
                                <div class="check"></div>
                            @else
                                <div class="uncheck"></div>
                            @endif
                        </td>
                        <td class="td-15"> Não</td>

                        <td class="td-5">
                            @if ($ficha_acompanhamento->acidentes_atividades_militares == '3')
                                <div class="check"></div>
                            @else
                                <div class="uncheck"></div>
                            @endif
                        </td>
                        <td class="td-55">Palestra de Recuperação</td>
                    </tr>
                    <tr>
                        <td class="td-opcoes"> BI que Publicou: </td>
                        <td class="" colspan="6">{{ $ficha_acompanhamento->acidentes_atividades_militares_bi }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>

            <table class="table-palestras">
                <tbody>
                    <tr>
                        <td colspan="7"><b>Assistiu à Palestra de Prevenção de Acidentes Automobilísticos?</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="td-5">
                            @if ($ficha_acompanhamento->acidentes_automobilisticos == '1')
                                <div class="check"></div>
                            @else
                                <div class="uncheck"></div>
                            @endif
                        </td>
                        <td class="td-15 text-left"> Sim</td>

                        <td class="td-5">
                            @if ($ficha_acompanhamento->acidentes_automobilisticos == '2')
                                <div class="check"></div>
                            @else
                                <div class="uncheck"></div>
                            @endif
                        </td>
                        <td class="td-15"> Não</td>

                        <td class="td-5">
                            @if ($ficha_acompanhamento->acidentes_automobilisticos == '3')
                                <div class="check"></div>
                            @else
                                <div class="uncheck"></div>
                            @endif
                        </td>
                        <td class="td-55">Palestra de Recuperação</td>
                    </tr>
                    <tr>
                        <td class="td-opcoes"> BI que Publicou: </td>
                        <td class="" colspan="6">{{ $ficha_acompanhamento->acidentes_automobilisticos_bi }}</td>
                    </tr>
                </tbody>
            </table>
            <br>

            <table class="table-palestras">
                <tbody>
                    <tr>
                        <td colspan="5"><b>Possui Carteira Nacional de Habilitação?</b> Se sim:</td>
                    </tr>
                    <tr>
                        <td class="td-60"> Documentação verificada?</td>

                        <td class="td-5">
                            @if ($ficha_acompanhamento->possui_cnh == '1')
                                <div class="check"></div>
                            @else
                                <div class="uncheck"></div>
                            @endif
                        </td>
                        <td class="td-15"> Sim</td>

                        <td class="td-5">
                            @if ($ficha_acompanhamento->possui_cnh == '2')
                                <div class="check"></div>
                            @else
                                <div class="uncheck"></div>
                            @endif
                        </td>
                        <td class="td-15"> Não</td>
                    </tr>
                </tbody>
            </table>
            <br>

            <table class="table-palestras">
                <tbody>
                    <tr>
                        <td class="text-justify" colspan="7"><b>Se Categoria A, realizou o Estágio de Prevenção de
                                Acidentes Motociclísticos?</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="td-5">
                            @if ($ficha_acompanhamento->acidentes_motociclisticos == '1')
                                <div class="check"></div>
                            @else
                                <div class="uncheck"></div>
                            @endif
                        </td>
                        <td class="td-15 text-left"> Sim</td>

                        <td class="td-5">
                            @if ($ficha_acompanhamento->acidentes_motociclisticos == '2')
                                <div class="check"></div>
                            @else
                                <div class="uncheck"></div>
                            @endif
                        </td>
                        <td class="td-15"> Não</td>

                        <td class="td-5">
                            @if ($ficha_acompanhamento->acidentes_motociclisticos == '3')
                                <div class="check"></div>
                            @else
                                <div class="uncheck"></div>
                            @endif
                        </td>
                        <td class="td-55">Palestra de Recuperação</td>
                    </tr>
                    <tr>
                        <td class="td-opcoes"> BI que Publicou: </td>
                        <td class="" colspan="6">{{ $ficha_acompanhamento->acidentes_motociclisticos_bi }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table-palestras">
                <tbody>
                    <tr>
                        <td colspan="10">Como foi classificada a perícia na condução de motocicleta?</td>
                    </tr>
                    <tr>
                        <td class="td-5">
                            @if ($ficha_acompanhamento->conducao_motocicleta == 'E')
                                <div class="check"></div>
                            @else
                                <div class="uncheck"></div>
                            @endif
                        </td>
                        <td class="td-15"> E</td>

                        <td class="td-5">
                            @if ($ficha_acompanhamento->conducao_motocicleta == 'MB')
                                <div class="check"></div>
                            @else
                                <div class="uncheck"></div>
                            @endif
                        </td>
                        <td class="td-15"> MB</td>

                        <td class="td-5">
                            @if ($ficha_acompanhamento->conducao_motocicleta == 'B')
                                <div class="check"></div>
                            @else
                                <div class="uncheck"></div>
                            @endif
                        </td>
                        <td class="td-15"> B</td>

                        <td class="td-5">
                            @if ($ficha_acompanhamento->conducao_motocicleta == 'R')
                                <div class="check"></div>
                            @else
                                <div class="uncheck"></div>
                            @endif
                        </td>
                        <td class="td-15"> R</td>

                        <td class="td-5">
                            @if ($ficha_acompanhamento->conducao_motocicleta == 'I')
                                <div class="check"></div>
                            @else
                                <div class="uncheck"></div>
                            @endif
                        </td>
                        <td class="td-15"> I</td>
                    </tr>
                </tbody>
            </table>
            <br>

            <table class="table-palestras">
                <tbody>
                    <tr>
                        <td colspan="2"><b>Foi realizada a Visita Social?</b></td>
                    </tr>
                    @if (!$visitas_sociais->isEmpty())
                        @foreach ($visitas_sociais as $visita)
                            <tr>
                                <td class="td-20 text-justify"><b> Data:</b></td>
                                <td class="text-justify">{{ date('d/m/Y', strtotime($visita->data)) }}</td>
                            </tr>
                            <tr>
                                <td class="td-20 text-justify v-align-top"> <b>Relato</b></td>
                                <td class="text-justify">{{ $visita->relato }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="2" class="text-justify"> Nenhuma visita social foi realizada</td>
                        </tr>
                    @endif
                    <br>
                    <tr>
                        <td colspan="2" class=" text-right">
                            Visto do Cmt Fração: _____________________________
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
        </div>
    </div>
    <div class="page_break"></div>
    <div class="grid-container">
        <div class="grid-item-1">
            @if (!$carros->isEmpty())
                @foreach ($carros as $carro)
                    <table class="table-palestras">
                        <tbody>
                            <tr>
                                <td colspan="3"><b>Possui automóvel?</b> Se sim:</td>
                            </tr>
                            <tr>
                                <td class="td-60"><b>Modelo:</b> {{ $carro->modelo }}</td>
                                <td colspan="2" class="td-40 text-align-right"><b>Ano:</b> {{ $carro->ano }}</td>
                            </tr>
                            <tr>
                                <td><b>Cor:</b> {{ $carro->cor }} </td>
                                <td colspan="2" class="text-align-right"><b>Placa:</b> {{ $carro->placa }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">- Lista de Verificação:</td>
                            </tr>
                            <tr>
                                <td class="text-center">Documentação </td>
                                <td class="td-5 text-right">
                                    @if ($carro->documentacao == '1')
                                        <div class="check"></div>
                                    @else
                                        <div class="uncheck"></div>
                                    @endif
                                </td>
                                <td class="text-left">@if ($carro->documentacao == '1')ok @endif</td>
                            </tr>
                            <tr>
                                <td class="text-center">Pneus </td>
                                <td class="td-5 text-right">
                                    @if ($carro->pneus == '1')
                                        <div class="check"></div>
                                    @else
                                        <div class="uncheck"></div>
                                    @endif
                                </td>
                                <td class="text-left">@if ($carro->pneus == '1')ok @endif</td>
                            </tr>
                            <tr>
                                <td class="text-center">Faróis </td>
                                <td class="td-5 text-right">
                                    @if ($carro->farois == '1')
                                        <div class="check"></div>
                                    @else
                                        <div class="uncheck"></div>
                                    @endif
                                </td>
                                <td class="text-left">@if ($carro->farois == '1')ok @endif</td>
                            </tr>
                            <tr>
                                <td class="text-center">Luzes de Sinalização </td>
                                <td class="td-5 text-right">
                                    @if ($carro->luzes_sinalizacao == '1')
                                        <div class="check"></div>
                                    @else
                                        <div class="uncheck"></div>
                                    @endif
                                </td>
                                <td class="text-left">@if ($carro->luzes_sinalizacao == '1')ok @endif</td>
                            </tr>
                            <tr>
                                <td class="text-center">Retrovisores </td>
                                <td class="td-5 text-right">
                                    @if ($carro->retrovisores == '1')
                                        <div class="check"></div>
                                    @else
                                        <div class="uncheck"></div>
                                    @endif
                                </td>
                                <td class="text-left">@if ($carro->retrovisores == '1')ok @endif</td>
                            </tr>
                            <tr>
                                <td class="text-center">Triângulo de Sinalização </td>
                                <td class="td-5 text-right">
                                    @if ($carro->triangulo_sinalizacao == '1')
                                        <div class="check"></div>
                                    @else
                                        <div class="uncheck"></div>
                                    @endif
                                </td>
                                <td class="text-left">@if ($carro->triangulo_sinalizacao == '1')ok @endif</td>
                            </tr>
                            <tr>
                                <td class="text-center">Parabrisas/Limpadores </td>
                                <td class="td-5 text-right">
                                    @if ($carro->parabrisa_limpador == '1')
                                        <div class="check"></div>
                                    @else
                                        <div class="uncheck"></div>
                                    @endif
                                </td>
                                <td class="text-left">@if ($carro->parabrisa_limpador == '1')ok @endif</td>
                            </tr>
                            <br>
                            <tr>
                                <td colspan="3" class=" text-right">
                                    Visto do Cmt Fração: _____________________________
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endforeach
            @else
                <table class="table-palestras">
                    <tbody>
                        <tr>
                            <td colspan="3"><b>Possui automóvel?</b> Se sim:</td>
                        </tr>
                        <tr>
                            <td class="td-60"><b>Modelo:</b> </td>
                            <td colspan="2" class="td-40 text-align-right"><b>Ano:</b></td>
                        </tr>
                        <tr>
                            <td><b>Ano:</b> </td>
                            <td colspan="2" class="text-align-right"><b>Placa:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3">- Lista de Verificação:</td>
                        </tr>
                        <tr>
                            <td class="text-center">Documentação </td>
                            <td class="td-5 text-right">
                                <div class="uncheck"></div>
                            </td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-center">Pneus </td>
                            <td class="td-5 text-right">
                                <div class="uncheck"></div>
                            </td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-center">Faróis </td>
                            <td class="td-5 text-right">
                                <div class="uncheck"></div>
                            </td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-center">Luzes de Sinalização </td>
                            <td class="td-5 text-right">
                                <div class="uncheck"></div>
                            </td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-center">Retrovisores </td>
                            <td class="td-5 text-right">
                                <div class="uncheck"></div>
                            </td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-center">Triângulo de Sinalização </td>
                            <td class="td-5 text-right">
                                <div class="uncheck"></div>
                            </td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-center">Parabrisas/Limpadores </td>
                            <td class="td-5 text-right">
                                <div class="uncheck"></div>
                            </td>
                            <td class="text-left"></td>
                        </tr>
                        <br>
                        <tr>
                            <td colspan="3" class=" text-right">
                                Visto do Cmt Fração: _____________________________
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endif

            <br>
            @if (!$motos->isEmpty())
                @foreach ($motos as $moto)
                    <table class="table-palestras">
                        <tbody>
                            <tr>
                                <td colspan="3"><b>Possui motocicleta?</b> Se sim:</td>
                            </tr>
                            <tr>
                                <td class="td-60"><b>Modelo:</b> {{ $moto->modelo }}</td>
                                <td colspan="2" class="td-40 text-align-right"><b>Ano:</b> {{ $moto->ano }}</td>
                            </tr>
                            <tr>
                                <td><b>Cor:</b> {{ $moto->cor }} </td>
                                <td colspan="2" class="text-align-right"><b>Placa:</b> {{ $moto->placa }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">- Lista de Verificação:</td>
                            </tr>
                            <tr>
                                <td class="text-center">Documentação </td>
                                <td class="td-5 text-right">
                                    @if ($moto->documentacao == '1')
                                        <div class="check"></div>
                                    @else
                                        <div class="uncheck"></div>
                                    @endif
                                </td>
                                <td class="text-left">@if ($moto->documentacao == '1')ok @endif</td>
                            </tr>
                            <tr>
                                <td class="text-center">Pneus </td>
                                <td class="td-5 text-right">
                                    @if ($moto->pneus == '1')
                                        <div class="check"></div>
                                    @else
                                        <div class="uncheck"></div>
                                    @endif
                                </td>
                                <td class="text-left">@if ($moto->pneus == '1')ok @endif</td>
                            </tr>
                            <tr>
                                <td class="text-center">Faróis </td>
                                <td class="td-5 text-right">
                                    @if ($moto->farois == '1')
                                        <div class="check"></div>
                                    @else
                                        <div class="uncheck"></div>
                                    @endif
                                </td>
                                <td class="text-left">@if ($moto->farois == '1')ok @endif</td>
                            </tr>
                            <tr>
                                <td class="text-center">Luzes de Sinalização </td>
                                <td class="td-5 text-right">
                                    @if ($moto->luzes_sinalizacao == '1')
                                        <div class="check"></div>
                                    @else
                                        <div class="uncheck"></div>
                                    @endif
                                </td>
                                <td class="text-left">@if ($moto->luzes_sinalizacao == '1')ok @endif</td>
                            </tr>
                            <tr>
                                <td class="text-center">Retrovisores </td>
                                <td class="td-5 text-right">
                                    @if ($moto->retrovisores == '1')
                                        <div class="check"></div>
                                    @else
                                        <div class="uncheck"></div>
                                    @endif
                                </td>
                                <td class="text-left">@if ($moto->retrovisores == '1')ok @endif</td>
                            </tr>
                            <tr>
                                <td class="text-center">Capacete INMETRO </td>
                                <td class="td-5 text-right">
                                    @if ($moto->capacete == '1')
                                        <div class="check"></div>
                                    @else
                                        <div class="uncheck"></div>
                                    @endif
                                </td>
                                <td class="text-left">@if ($moto->capacete == '1')ok @endif</td>
                            </tr>
                            <br>
                            <tr>
                                <td colspan="3" class=" text-right">
                                    Visto do Cmt Fração: _____________________________
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @endforeach
            @else
                <table class="table-palestras">
                    <tbody>
                        <tr>
                            <td colspan="3"><b>Possui motocicleta?</b> Se sim:</td>
                        </tr>
                        <tr>
                            <td class="td-60"><b>Modelo:</b> </td>
                            <td colspan="2" class="td-40 text-align-right"><b>Ano:</b></td>
                        </tr>
                        <tr>
                            <td><b>Ano:</b> </td>
                            <td colspan="2" class="text-align-right"><b>Placa:</b></td>
                        </tr>
                        <tr>
                            <td colspan="3">- Lista de Verificação:</td>
                        </tr>
                        <tr>
                            <td class="text-center">Documentação </td>
                            <td class="td-5 text-right">
                                <div class="uncheck"></div>
                            </td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-center">Pneus </td>
                            <td class="td-5 text-right">
                                <div class="uncheck"></div>
                            </td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-center">Faróis </td>
                            <td class="td-5 text-right">
                                <div class="uncheck"></div>
                            </td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-center">Luzes de Sinalização </td>
                            <td class="td-5 text-right">
                                <div class="uncheck"></div>
                            </td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-center">Retrovisores </td>
                            <td class="td-5 text-right">
                                <div class="uncheck"></div>
                            </td>
                            <td class="text-left"></td>
                        </tr>
                        <tr>
                            <td class="text-center">Capacete INMETRO </td>
                            <td class="td-5 text-right">
                                <div class="uncheck"></div>
                            </td>
                            <td class="text-left"></td>
                        </tr>
                        <br>
                        <tr>
                            <td colspan="3" class=" text-right">
                                Visto do Cmt Fração: _____________________________
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endif
            <br>

            <table class="table-palestras">
                <tbody>
                    <tr>
                        <td colspan="2"><b>Em caso de Acidente, devo ligar para?</b></td>
                    </tr>
                    <tr>
                        <td><b>Quem? </b> </td>
                        <td class="text-align-right">
                            @if ($ficha_acompanhamento->nome_pai != null)
                                {{ $ficha_acompanhamento->nome_pai }}
                            @else
                                ________________________________________
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><b>Nr do Telefone:</b> </td>
                        <td class="text-align-right">                            
                            @if ($ficha_acompanhamento->contato_pai != null)
                                {{ $ficha_acompanhamento->contato_pai }}
                            @else
                                ________________________________________
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="grid-item-2">
            <table class="table-palestras">
                <tbody>
                    <tr>
                        <td colspan="2"><b>Observações/Providências:</b></td>
                    </tr>
                    @for ($i = 0; $i<30; $i++)
                    <tr>
                        <td colspan="2">_________________________________________________________________</td>
                    </tr>
                    @endfor
                    <tr>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
