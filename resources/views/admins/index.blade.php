@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Painel de Administradores</h2>
        </div>
        <div class="row">
            <a class="btn btn-primary col-3" href="{{ route('militares.index') }}"> Gerenciar Militares</a>
            <a class="btn btn-primary col-3" href="{{ route('users.index') }}"> Gerenciar Usuários</a>
            <a class="btn btn-primary col-3" href="{{ route('roles.index') }}"> Gerenciar Níveis de Acesso</a>
            <a class="btn btn-primary col-3" href="{{ route('postos.index') }}"> Gerenciar Posto/Grad</a>
            <a class="btn btn-primary col-3" href="{{ route('subunidades.index') }}"> Gerenciar Subunidades</a>
            <a class="btn btn-primary col-3" href="{{ route('pelotoes.index') }}"> Gerenciar Pelotões</a>
            <a class="btn btn-primary col-3" href="{{ route('medicos.index') }}"> Gerenciar Médicos</a>
            <a class="btn btn-primary col-3" href="{{ route('vacinas.index') }}"> Gerenciar Vacinas</a>
            <a class="btn btn-primary col-3" href="{{ route('objetivos_instrucoes.index') }}"> Gerenciar OII</a>
        </div>
    </div>
</div>

@endsection
