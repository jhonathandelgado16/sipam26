@extends('layouts.app')

@section('content')
    <div class="row margin-bottom-15">
        <div class="pull-right col-8">
            <a class="btn btn-white" href="{{ route('ficha_sipam.curso_index', $militar->id) }}"><img
                    src="{{ url('storage/icons/back.png') }}" height="20"> Voltar</a>
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

        @if ($message = Session::get('danger'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="col-12 row justify-content-center">
            <div class="col-12 row">
                <div class="title-sipam row">
                    <h2 class="col-10">Cadastrar Cursos e Estágios</h2>
                </div>
            </div>

            {!! Form::open(['route' => ['cursos.encontrar_curso', $militar->id], 'method' => 'POST']) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group margin-bottom-5">
                        <div class="col-12 row justify-content-end">
                            <strong>Pesquise o Nome do Curso, Estágio ou Instituição de Ensino</strong>
                            <input name="pesquisa" type="text" class="form-control" value="{{$pesquisa}}"
                                placeholder="Ex: Programador de Sistemas" required>
                            <button class="btn btn-primary col-2" type="submit"><ion-icon name="search-circle"></ion-icon> Pesquisar</button>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

            <table class="table text-center background-white">
                <tr>
                    <th>Nome</th>
                    <th>Horas</th>
                    <th>Instituicao de Ensino</th>
                    <th>Selecionar Curso</th>
                </tr>

                @if ($cursos != '')
                @foreach ($cursos as $curso)
                    <tr>
                        <td>{{ $curso->nome }}</td>
                        <td>{{ $curso->horas }}</td>
                        <td>{{ $curso->instituicao_ensino }}</td>
                        <td>
                            <a href="{{ route('cursos.create_com_curso', [$militar->id, $curso->id]  ) }}" data-btn-ok-label="Confirmar" data-btn-cancel-label="Cancelar" type="submit" class='btn btn-success' data-toggle="confirmation" data-title="Esse curso será inserido na ficha do {{$militar->getMilitar()}}, deseja prosseguir?"> <ion-icon name="checkmark-circle"></ion-icon></button>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="99"> Não encontrou o curso que deseja inserir? Cadastre o curso no sistema clicando no botão abaixo <ion-icon name="happy"></ion-icon> <br> <a class=" col-2 btn btn-primary" href="{{ route('ficha_sipam.curso_create', $militar->id) }}">Adicionar Curso <ion-icon name="add-circle"></ion-icon></a></td>
                </tr>
                
                @endif
            </table>

        </div>
    @endsection
