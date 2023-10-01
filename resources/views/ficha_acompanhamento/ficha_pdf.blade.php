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
                    <td class="text-align-right">________________________________________</td>
                </tr>
                <tr>
                    <td><b>Fração:</b> </td>
                    <td class="text-align-right">________________________________________</td>
                </tr>
                <tr>
                    <td><b>Nome Cmt/Ch:</b> </td>
                    <td class="text-align-right">________________________________________</td>
                </tr>
            </tbody>
        </table>

        <br>

        <h3 class="text-center h3-ficha">DADOS DO MILITAR</h3>
        <table class="table-acompanhamento">
            <tbody>
                <tr>
                    <td><b>(P/G) NOME:</b></td>
                    <td class="text-align-right">________________________________________</td>
                </tr>
                <tr>
                    <td><b>Nome Completo:</b> </td>
                    <td class="text-align-right">________________________________________</td>
                </tr>
                <tr>
                    <td><b>Nr Identidade:</b> </td>
                    <td class="text-align-right">________________________________________</td>
                </tr>
                <tr>
                    <td><b>Ano de Incorporação:</b> </td>
                    <td class="text-align-right">________________________________________</td>
                </tr>
                <tr>
                    <td><b>Nr Telefone:</b> </td>
                    <td class="text-align-right">________________________________________</td>
                </tr>
                <tr>
                    <td colspan="2"><b>Endereço Residencial:</b> </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-align-right">______________________________________________________________</td>
                </tr>
                <tr>
                    <td colspan="2"><b>Se casado, dados da esposa:</b> </td>
                </tr>
                <tr>
                    <td><b>Nome:</b> </td>
                    <td class="text-align-right">________________________________________</td>
                </tr>
                <tr>
                    <td><b>Nr Telefone:</b> </td>
                    <td class="text-align-right">________________________________________</td>
                </tr>
            </tbody>
        </table>

        <br>

        <h3 class="text-center h3-ficha">DADOS FAMILIARES</h3>
        <table class="table-acompanhamento">
            <tbody>
                <tr>
                    <td><b>Nome do pai/responsável:</b> </td>
                    <td class="text-align-right">________________________________________</td>
                </tr>
                <tr>
                    <td><b>Nr Telefone:</b> </td>
                    <td class="text-align-right">________________________________________</td>
                </tr>
                <br>
                <tr>
                    <td><b>Nome da mãe/responsável:</b> </td>
                    <td class="text-align-right">________________________________________</td>
                </tr>
                <tr>
                    <td><b>Nr Telefone:</b> </td>
                    <td class="text-align-right">________________________________________</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="grid-item-2">

        <table class="table-palestras">
            <tbody>
                <tr>
                    <td colspan="3"><b>Assistiu à Palestra de Prevenção de Acidentes nas Atividades Militares?</b></td>
                </tr>
                <tr>
                    <td class="td-opcoes"> Sim</td>
                    <td class="td-opcoes"> Não</td>
                    <td class="td-40">Palestra de Recuperação</td>
                </tr>
                <tr>
                    <td class="td-opcoes"> BI que Publicou: </td>
                    <td class="" colspan="2"></td>
                </tr>                
            </tbody>
        </table>
        <br>

        <table class="table-palestras">
            <tbody>
                <tr>
                    <td colspan="3"><b>Assistiu à Palestra de Prevenção de Acidentes Automobilísticos?</b></td>
                </tr>
                <tr>
                    <td class="td-opcoes"> Sim</td>
                    <td class="td-opcoes"> Não</td>
                    <td class="td-40">Palestra de Recuperação</td>
                </tr>
                <tr>
                    <td class="td-opcoes"> BI que Publicou: </td>
                    <td class="" colspan="2"></td>
                </tr>                
            </tbody>
        </table>
        <br>

        <table class="table-palestras">
            <tbody>
                <tr>
                    <td colspan="3"><b>Possui Carteira Nacional de Habilitação?</b> Se sim:</td>
                </tr>
                <tr>
                    <td class="td-60"> Documentação verificada?</td>
                    <td class="td-20"> Sim</td>
                    <td class="td-20"> Não</td>
                </tr>             
            </tbody>
        </table>
        <br>

        <table class="table-palestras">
            <tbody>
                <tr>
                    <td class="text-justify" colspan="3"><b>Se Categoria A, realizou o Estágio de Prevenção de Acidentes Motociclísticos?</b></td>
                </tr>
                <tr>
                    <td class="td-opcoes"> Sim</td>
                    <td class="td-opcoes"> Não</td>
                    <td class="td-40">Palestra de Recuperação</td>
                </tr>
                <tr>
                    <td class="td-opcoes"> BI que Publicou: </td>
                    <td class="" colspan="2"></td>
                </tr>                
            </tbody>
        </table>
        <table class="table-palestras">
            <tbody>
                <tr>
                    <td colspan="5">Como foi classificada a perícia na condução de motocicleta?</td>
                </tr>
                <tr>
                    <td class="td-20"> E</td>
                    <td class="td-20"> MB</td>
                    <td class="td-20"> B</td>
                    <td class="td-20"> R</td>
                    <td class="td-20"> I</td>
                </tr>             
            </tbody>
        </table>
        <br>

        <table class="table-palestras">
            <tbody>
                <tr>
                    <td colspan="2"><b>Foi realizada a Visita Social?</b></td>
                </tr>
                <tr>
                    <td class="td-20 text-justify"><b> Data:</b></td>
                    <td class="text-justify"></td>
                </tr>     
                <tr>
                    <td class="td-20 text-justify"> <b>Relato</b></td>
                    <td class="text-justify"></td>
                </tr>   
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
        <table class="table-palestras">
            <tbody>
                <tr>
                    <td colspan="2"><b>Possui automóvel?</b> Se sim:</td>
                </tr>
                <tr>
                    <td class="td-60"><b>Modelo:</b> </td>
                    <td class="td-40 text-align-right" ><b>Ano:</b></td>
                </tr>
                <tr>
                    <td><b>Ano:</b> </td>
                    <td class="text-align-right" ><b>Placa:</b></td>
                </tr> 
                <tr>
                    <td colspan="2">- Lista de Verificação:</td>
                </tr>
                <tr>
                    <td class="text-center">Documentação </td>
                    <td class="text-left" >Ok</td>
                </tr> 
                <tr>
                    <td class="text-center">Pneus </td>
                    <td class="text-left" >Ok</td>
                </tr> 
                <tr>
                    <td class="text-center">Faróis </td>
                    <td class="text-left" >Ok</td>
                </tr> 
                <tr>
                    <td class="text-center">Luzes de Sinalização </td>
                    <td class="text-left" >Ok</td>
                </tr> 
                <tr>
                    <td class="text-center">Retrovisores </td>
                    <td class="text-left" >Ok</td>
                </tr> 
                <tr>
                    <td class="text-center">Triângulo de Sinalização </td>
                    <td class="text-left" >Ok</td>
                </tr> 
                <tr>
                    <td class="text-center">Parabrisas/Limpadores </td>
                    <td class="text-left" >Ok</td>
                </tr> 
                <tr>
                    <td colspan="2" class=" text-right">                         
                        Visto do Cmt Fração: _____________________________
                    </td>
                </tr>            
            </tbody>
        </table>
        <br>

        <table class="table-palestras">
            <tbody>
                <tr>
                    <td colspan="2"><b>Possui motocicleta?</b> Se sim:</td>
                </tr>
                <tr>
                    <td class="td-60"><b>Modelo:</b> </td>
                    <td class="td-40 text-align-right" ><b>Ano:</b></td>
                </tr>
                <tr>
                    <td><b>Ano:</b> </td>
                    <td class="text-align-right" ><b>Placa:</b></td>
                </tr> 
                <tr>
                    <td colspan="2">- Lista de Verificação:</td>
                </tr>
                <tr>
                    <td class="text-center">Documentação </td>
                    <td class="text-left" >Ok</td>
                </tr> 
                <tr>
                    <td class="text-center">Pneus </td>
                    <td class="text-left" >Ok</td>
                </tr> 
                <tr>
                    <td class="text-center">Faróis </td>
                    <td class="text-left" >Ok</td>
                </tr> 
                <tr>
                    <td class="text-center">Luzes de Sinalização </td>
                    <td class="text-left" >o Ok</td>
                </tr> 
                <tr>
                    <td class="text-center">Retrovisores </td>
                    <td class="text-left" >o Ok</td>
                </tr> 
                <tr>
                    <td class="text-center">Capacete INMETRO </td>
                    <td class="text-left" >Ok</td>
                </tr> 
                <tr>
                    <td colspan="2" class=" text-right">                         
                        Visto do Cmt Fração: _____________________________ 
                    </td>
                </tr>            
            </tbody>
        </table>
        <br>

        <table class="table-palestras">
            <tbody>
                <tr>
                    <td colspan="2"><b>Em caso de Acidente, devo ligar para?</b></td>
                </tr>
                <tr>
                    <td><b>Quem? </b> </td>
                    <td class="text-align-right">________________________________________</td>
                </tr>
                <tr>
                    <td><b>Nr do Telefone:</b> </td>
                    <td class="text-align-right">________________________________________</td>
                </tr>    
            </tbody>
        </table>
    </div>
</div>
@endsection
