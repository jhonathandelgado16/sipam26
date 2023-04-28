@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Usuário</h2>
        </div>
        <div class="pull-right col-6">
            <a class="btn btn-white" href="{{ route('users.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Barro!</strong> Temos um erro com as informações que você preencheu.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            @if($error == 'validation.required')
                <li>Por favor preencha as informações necessárias</li>
            @else
                <li>{{ $error }}</li>
            @endif
            @endforeach
        </ul>
    </div>
@endif


{!! Form::model($user, ['method' => 'PATCH', 'class' => 'justify-content-center row', 'route' => ['users.update', $user->id]]) !!}
<div class="col-10 row">
    <div class="col-6">
        <div class="form-group">
            <strong>Nome:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-2">
        <strong>Subunidade:</strong>
        <select name="subunidade_id" class="form-select">
            @foreach ($subunidades as $key => $subunidade)
                @if($user->subunidade_id == $subunidade->id)
                    <option value="{{$subunidade->id}}" selected>
                        {{$subunidade->nome}}
                    </option>
                @else
                    <option value="{{$subunidade->id}}">
                        {{$subunidade->nome}}
                    </option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="col-3">
        <div class="form-group">
            <strong>Nível de Acesso:</strong>
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-select')) !!}
        </div>
    </div>

    <div class="col-4">
        <div class="form-group">
            <strong>Email Login:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <strong>Senha:</strong>
            {!! Form::password('password', array('placeholder' => 'Senha','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <strong>Confirme a Senha:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirme a Senha','class' => 'form-control')) !!}
        </div>
    </div>     
   
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Concluir</button>
    </div>
</div>
{!! Form::close() !!}

@endsection