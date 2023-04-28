@extends('layouts.app')

@section('content')
<div class="row">
    <div class="pull-left col-8">
        <h2>Gerenciamento de Níveis de Acesso</h2>
    </div>
    <div class="col-lg-12 margin-tb">
        <div class="row">
            <div class="pull-right col-8">
                <a class="btn btn-white" href="{{ route('users.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
            </div>
            <div class="row justify-content-end col-4">
            @can('role-create')
                <a class="btn btn-primary col-10" href="{{ route('roles.create') }}"> Criar Novo Nível de Acesso</a>
                @endcan
            </div>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table text-center">
    <tr>
        <th>Nº</th>
        <th>Nome</th>
        <th width="400px">Ações</th>
    </tr>

    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-white" href="{{ route('roles.show',$role->id) }}"><img src="{{url('storage/icons/view.png')}}" height="20"> Visualizar</a>
            @can('role-edit')
                <a class="btn btn-white" href="{{ route('roles.edit',$role->id) }}"><img src="{{url('storage/icons/edit.png')}}" height="20"> Editar</a>
            @endcan
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    <button type="submit" class='btn btn-white'> <img src="{{url('storage/icons/delete.png')}}" height="20"> Deletar</button>
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>


{!! $roles->render() !!}

@endsection
