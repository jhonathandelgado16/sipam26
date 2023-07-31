@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Adicionar Militares na Fração: {{ $fracao->nome }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-white" href="{{ route('militares_fracoes.index') }}"><img src="{{ url('storage/icons/back.png') }}"
                        height="20"> Voltar</a>
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

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    {!! Form::open(['route' => ['militares_fracoes.salvar', $fracao->id], 'method' => 'POST']) !!}
    <div class="row">
        <div class="col-6 text-center">
            <h4>Militares fora da Fração</h4>
        </div>
        <div class="offset-1 col-5 text-center">
            <h4>Militares da Fração</h4>
        </div>
        <div class="col-6 scroll-y-400">
            @foreach ($militares as $militar)
                <div class="row item-oii text-center">
                    <div class="col-1"><input type="checkbox" name="militares[]" id=""
                            value="{{ $militar->id }}"></div>
                    <div class="col-11">{{ $militar->getMilitar() }}</div>
                </div>
            @endforeach
        </div>
        <div class="col-1">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn-pass btn btn-primary">Cadastrar 
                    <ion-icon name="chevron-forward-outline"></ion-icon>
                    <ion-icon name="chevron-forward-outline"></ion-icon>
                    <ion-icon name="chevron-forward-outline"></ion-icon>
                </button>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-5 scroll-y-400">
            @foreach ($militares_fracao as $militar)
                {!! Form::open(['route' => ['militares_fracoes.remover', $militar->id], 'method' => 'POST']) !!}
                <div class="row item-oii text-center">
                    <div class="col-9">{{ $militar->militar->getMilitar() }}</div>
                    <div class="col-3"><button type="submit" class="btn-danger btn">Remover</button></div>
                </div>
                {!! Form::close() !!}
            @endforeach
        </div>
    </div>

@endsection
