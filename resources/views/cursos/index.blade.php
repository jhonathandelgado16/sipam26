@extends('layouts.app')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <div class="col-12 row justify-content-center">
            <div class="col-12">
                <div class="col-12">
                    <div class="title-sipam row">
                        <h2 class="col-12">Cursos e Estágios aguardando aprovação</h2>
                    </div>
                </div>
                <table class="table text-center background-white">
                    <tr>
                        <th>Nome</th>
                        <th>Horas</th>
                        <th>Instituicao de Ensino</th>
                        <th>Vai pontuar</th>
                        <th>Não vai pontuar</th>
                    </tr>
                    @if ($cursos_aguardando->first())
                        @foreach ($cursos_aguardando as $curso)
                            <tr>
                                <td>{{ $curso->nome }}</td>
                                <td>{{ $curso->horas }}</td>
                                <td>{{ $curso->instituicao_ensino }}</td>
                                <td>
                                    {!! Form::open(['method' => 'POST', 'route' => ['cursos.aprovar'], 'style' => 'display:inline']) !!}
                                    <input class="d-none" name="curso_id" type="text" value="{{ $curso->id }}">
                                    <button data-btn-ok-label="Confirmar" data-btn-cancel-label="Cancelar" type="submit"
                                        class='btn btn-success' data-toggle="confirmation"
                                        data-title="Esse curso vai pontuar, deseja confirmar?"> <ion-icon
                                            name="checkmark-circle"></ion-icon></button>
                                    {!! Form::close() !!}
                                </td>
                                <td>
                                    {!! Form::open(['method' => 'POST', 'route' => ['cursos.reprovar'], 'style' => 'display:inline']) !!}
                                    <input class="d-none" name="curso_id" type="text" value="{{ $curso->id }}">
                                    <button data-btn-ok-label="Confirmar" data-btn-cancel-label="Cancelar" type="submit"
                                        class='btn btn-danger' data-toggle="confirmation"
                                        data-title="Esse curso não vai pontuar, deseja confirmar?"> <ion-icon
                                            name="close-circle"></ion-icon></button>
                                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="99">Não existem cursos aguardando aprovação</td>
                        </tr>
                    @endif

                </table>
            </div>
        </div>
        <div class="col-12 row justify-content-center">
            <div class="col-12">
                <div class="col-12">
                    <div class="subtitle-green row">
                        <h2 class="col-10 font-small">Cursos autorizados</h2>
                    </div>
                    <div class="row scroll-y-400">
                        @foreach ($cursos_pontuando as $curso)
                            <div class="col-3 card-cursos font-small text-center">
                               <h1 class="font-small">{{ $curso->nome }}</h1>
                               <h2 class="font-x-small color-green">{{ $curso->instituicao_ensino}}</h2>
                               <h3 class="col-12 font-small color-green text-right"><ion-icon name="checkmark-circle"></ion-icon></h3>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12">
                    <div class="subtitle-red row">
                        <h2 class="col-10 font-small">Cursos não autorizados</h2>
                    </div>
                    <div class="row scroll-y-400">
                        @foreach ($cursos_nao_pontuando as $curso)
                            <div class="col-3 card-cursos font-small text-center">
                               <h1 class="font-small">{{ $curso->nome }}</h1>
                               <h2 class="font-x-small color-red">{{ $curso->instituicao_ensino}}</h2>
                               <h3 class="col-12 font-small color-red text-right"><ion-icon name="close-circle"></ion-icon></h3>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
