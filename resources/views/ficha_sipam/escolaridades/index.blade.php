@extends('layouts.app')

@section('content')
<div class="row margin-bottom-15">
    <div class="pull-right col-8">
        <a class="btn btn-white" href="{{ route('ficha_sipam.index', $militar->id) }}"><img src="{{ url('storage/icons/back.png') }}"
                height="20"> Voltar</a>
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
            <h2 class="col-10">Escolaridade do Militar</h2>
            <a class=" col-2 btn btn-primary" href="{{ route('ficha_sipam.escolaridade_create', $militar->id) }}">Adicionar escolaridade <ion-icon name="add-circle"></ion-icon></a>
        </div>
        </div>
        <table class="table text-center">
            <tr>
                <th>Escolaridade</th>
                <th>Instituição de Ensino</th>
                <th>Pontos</th>
                <th>Editar</th>
            </tr>
    
            @foreach ($escolaridades as $escolaridade)
            <tr>
                <td>{{ $escolaridade->nome }}</td>
                <td>{{ $escolaridade->instituicao_ensino }}</td>
                <td class="font-color-004aad">
                    {{ $escolaridade->pontos }} <ion-icon name="arrow-up-circle-outline"></ion-icon>
                </td>
                @can('militar-edit')
                <td>
                    <a class="btn btn-white" href="{{ route('ficha_sipam.escolaridade_edit', $escolaridade->id) }}"><img src="{{url('storage/icons/edit.png')}}" height="20"></a>
                    {!! Form::open(['method' => 'DELETE','route' => ['ficha_sipam.escolaridade_delete', $escolaridade->id],'style'=>'display:inline']) !!}
                        <button data-btn-ok-label="Excluir" data-btn-cancel-label="Cancelar" type="submit" class='btn btn-white' data-toggle="confirmation" data-title="Deseja realmente escluir esta escolaridade?"> <img src="{{url('storage/icons/delete.png')}}" height="20"></button>
                    {!! Form::close() !!}
                </td>
                @endcan
            </tr>
            @endforeach
        </table>
    </div>
@endsection
