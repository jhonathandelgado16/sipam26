@extends('layouts.app')

@section('content')


<div class="row margin-bottom-15">
    <div class="pull-right col-8">
        <a class="btn btn-white" href="{{ route('militares.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
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
                <img class="col-md-8" src="{{url('storage/caveira.png')}}">
            </div>
            <div class="col-10 row">
                <h3 class="text-center">{{$militar->getMilitar()}}</h3>
                <div class="row">
                    <div class="col-4 text-left row">
                        <h4 class="">Fração: {{$militar->pelotao->pelotao}} - {{$militar->pelotao->cmt_pelotao}}</h4>
                    </div>
                    <div class="col-4 text-left row">
                        <h4>Subunidade: {{$militar->subunidade->nome}}</h4>
                    </div>
                    <div class="col-4 text-left row">
                        <h4>Situação: {{$militar->situacao}}</h4>
                    </div>
                    <div class="col-6 text-left row">
                        <h4 class="">Nome Completo: {{$militar->nome}}</h4>
                    </div>
                    <div class="col-3 text-left row">
                        <h4 class="col">CPF: {{$militar->cpf}}</h4>
                    </div>
                    <div class="col-3 text-left row">
                        <h4 class="col">IDT: {{$militar->idt_militar}}</h4>
                    </div>
                    <div class="col-4 text-left row">
                        <h4 class="col">Contato: {{$militar->contato}}</h4>
                    </div>
                    <div class="col-8 text-left row">
                        <h4 class="col-12">Endereço: {{$militar->endereco}}</h4>
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
        @if($fatos->isNotEmpty())
        @foreach ($fatos as $key => $fato)
        <div class="row card-fo">
            <div class="col-12 row">
                <h3 class="col-2 text-center">{{$fato->fato_observado}}</h3>
                <h3 class="offset-7 col-3 text-center">{{$fato->getDataFormatada()}}</h3>
            </div>
            <div class="row">
                <h4 class="col-12 text-center">
                    {{$fato->descricao}}
                </h4>
            </div>
            <div class="row">
                <h3 class="offset-6 col-6 text-center"> {{$fato->militar_que_observou}}</h3>
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
            <a class=" col-3 btn btn-caderneta" href="{{ route('obs.inserir', $militar->id) }}">Cadastrar nova observação</a>
        </div>

        @if($observacoes->isNotEmpty())
        @foreach ($observacoes as $key => $observacao)
            <div class="row card-fo">
                <div class="col-12 row">
                    <h3 class="offset-9 col-3 text-center">{{$observacao->getDataFormatada()}}</h3>
                </div>
                <div class="row">
                    <h4 class="col-12 text-center">
                        {{$observacao->observacao}}
                    </h4>
                </div>
                <div class="row">
                    <h3 class="offset-6 col-6 text-center">{{$fato->militar_que_observou}}</h3>
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
            <a class=" col-3 btn btn-caderneta" href="{{ route('visita_medica.inserir', $militar->id) }}">Cadastrar nova visita médica</a>
        </div>
        @if($visitas_medicas->isNotEmpty())
        @foreach ($visitas_medicas as $key => $visita_medica)
        <div class="row card-fo">
            <div class="col-12 row">
                <h3 class="col-6 text-center">{{$visita_medica->medico->getMedico()}}</h3>
                <h3 class="offset-3 col-3 text-center">{{$visita_medica->getDataFormatada()}}</h3>
            </div>
            <div class="row">
                <h4 class="col-12 text-center">
                    {{$visita_medica->descricao}}
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
            <a class=" col-3 btn btn-caderneta" href="{{ route('vacina_aplicada.inserir', $militar->id) }}">Cadastrar nova vacina aplicada</a>
        </div>
        @if($vacinas_aplicadas->isNotEmpty())
        @foreach ($vacinas_aplicadas as $key => $vacina_aplicada)
        <div class="row card-fo">
            <div class="col-12 row">
                <h3 class="offset-9 col-3 text-center">{{$vacina_aplicada->getDataFormatada()}}</h3>
            </div>
            <div class="row">
                <h4 class="col-12 text-center">
                    {{$vacina_aplicada->vacina->vacina}}
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

</div>
@endsection
