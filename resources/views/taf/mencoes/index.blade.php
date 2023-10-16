@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <div class="pull-left col-8">
                    <h2>Controle de Menções de TAF</h2>
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
                            @can('posto-create')
                                <a class="col-10 btn btn-primary" href="{{ route('mencoes_taf.create') }}"> Adicionar Menção</a>
                            @endcan
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
        <div class="col-8">
            <table class="table text-center col-12">
                <tr>
                    <th>Menções</th>
                    <th>Pontos</th>
                    <th width="280px">Ações</th>
                </tr>

                @foreach ($mencoes as $mencao)
                    <tr>
                        <td>{{ $mencao->mencao }}</td>
                        <td>{{ $mencao->pontos }}</td>
                        <td>
                            <a class="btn btn-white" href="{{ route('mencoes_taf.edit', $mencao) }}"><img
                                    src="{{ url('storage/icons/edit.png') }}" height="20"> Editar</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
