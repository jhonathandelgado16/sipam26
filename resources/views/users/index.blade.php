@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Controle de Usuários</h2>
        </div>
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <div class="pull-right col-6">
                    <a class="btn btn-white" href="{{ route('admins.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
                </div>
                <div class="row justify-content-end col-6">
                    @if($user_auth->hasRole('Admin'))
                    <div class="row">
                        <a class="btn btn-primary col-6" href="{{ route('users.create') }}"> Criar Novo Usuário</a>
                        <a class="btn btn-primary col-6" href="{{ route('roles.index') }}"> Gerenciar Níveis de Acesso</a>
                    </div>
                    @endif
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


<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Roles</th>
        <th width="280px">Action</th>
    </tr>
@foreach ($data as $key => $user)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <label class="">{{ $v }}</label>
                @endforeach
            @endif
        </td>
        @if($user_auth->hasRole('Admin'))
        <td>
            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
        </td>
        @endif
    </tr>
@endforeach
</table>

{!! $data->render() !!}
@endsection
