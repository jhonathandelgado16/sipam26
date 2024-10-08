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
            <a class="btn btn-primary col-3" href="{{ route('fiib.definir') }}"> Gerenciar FIIB</a>
            <a class="btn btn-primary col-3" href="{{ route('categorias_avaliacoes.index') }}"> Gerenciar Categorias de Avaliações</a>
            <a class="btn btn-primary col-3" href="{{ route('categorias_atributos.index') }}"> Gerenciar Categorias de Atributos</a>
            <a class="btn btn-primary col-3" href="{{ route('atributos.index') }}"> Gerenciar Atributos</a>
            <a class="btn btn-primary col-3" href="{{ route('fracoes.index') }}"> Gerenciar Frações</a>
            <a class="btn btn-primary col-3" href="{{ route('militares_fracoes.index') }}"> Definir Militares das Frações</a>
            <a class="btn btn-primary col-3" href="{{ route('escolaridades.index') }}"> Definir Escolaridades</a>
            <a class="btn btn-primary col-3" href="{{ route('mencoes_taf.index') }}"> Gerenciar Meções de TAF</a>
            <a class="btn btn-primary col-3" href="{{ route('taf_numeros.index') }}"> Gerenciar Números de TAF</a>
            <a class="btn btn-primary col-3" href="{{ route('publicacoes.index') }}"> Gerenciar Publicações</a>
            <a class="btn btn-primary col-3" href="{{ route('cursos_formacao.index') }}"> Gerenciar Cursos de Formação</a>
            <a class="btn btn-primary col-3" href="{{ route('cnh_categorias.index') }}"> Gerenciar Categorias de CNH</a>
        </div>
    </div>
</div>

@endsection
