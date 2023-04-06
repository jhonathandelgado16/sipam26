@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Adicionar Novo Pelotão</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-white" href="{{ route('pelotoes.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif


{!! Form::open(array('route' => 'pelotoes.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Pelotão:</strong>
            {!! Form::text('pelotao', null, array('placeholder' => 'Pelotão','class' => 'form-control')) !!}

            <strong>Cmt Pelotão:</strong>
            {!! Form::text('cmt_pelotao', null, array('placeholder' => 'Cmt Pelotão','class' => 'form-control')) !!}


            <strong>Subunidade:</strong>
            <select name="subunidade" class="form-control">
                @foreach ($subunidades as $key => $subunidade)
                <option value="{{$subunidade->id}}">
                    {{$subunidade->nome}}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </div>
</div>
{!! Form::close() !!}

@endsection
