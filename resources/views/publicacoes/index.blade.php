@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <div class="pull-left col-8">
                    <h2>Controle de Publicações</h2>
                </div>
                <div class="row justify-content-end col-4">

                </div>
                <div class="col-lg-12 margin-tb">
                    <div class="row">
                        <div class="pull-right col-8">
                            <a class="btn btn-white" href="{{ route('admins.index') }}"><img
                                    src="{{ url('storage/icons/back.png') }}" height="20"> Voltar</a>
                        </div>
                        <div class="row justify-content-end col-4">
                            <a class="col-10 btn btn-primary" href="{{ route('publicacoes.create') }}"> Adicionar publicação</a>
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
        <div class="col-12">
            <table class="table text-center col-12">
                <tr>
                    <th>Documento</th>
                    <th>Número</th>
                    <th>Data de publicação</th>
                    <th>Assunto</th>
                    <th width="80px">Ações</th>
                </tr>

                @foreach ($publicacoes as $publicacao)
                    <tr>
                        <td>{{ $publicacao->tipo }}</td>
                        <td>{{ $publicacao->numero }}</td>
                        <td>{{ $publicacao->getData() }}</td>
                        <td>{{ $publicacao->assunto }}</td>
                        <td>
                            <a class="btn btn-white" href="{{ route('publicacoes.edit', $publicacao->id) }}"><img
                                    src="{{ url('storage/icons/edit.png') }}" height="20"> Editar</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
