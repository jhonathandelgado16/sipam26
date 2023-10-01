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
                <h1 class="text-danger text-center"><ion-icon name="alert-circle"></ion-icon></h1>
                <h2 class="text-danger text-center">O cadastro de Cursos e Estágios está passando por manutenção no momento!</h2>
            </div>
        </div>
    </div>
    @endsection
