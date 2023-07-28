@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="row">
                <div class="pull-left col-12">
                    <h2>Definir Objetivos da Ficha da Instrução Individual Básica</h2>
                </div>
                <div class="col-lg-12 margin-tb">
                    <div class="row">
                        <div class="pull-right col-8">
                            <a class="btn btn-white" href="{{ route('admins.index') }}"><img
                                    src="{{ url('storage/icons/back.png') }}" height="20"> Voltar</a>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end col-4">

                </div>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row card-001eff">
        <div class="col-lg-6 margin-tb scroll-y">
            <h3 class="text-center">OII fora da FIIB</h3>

            @foreach ($objetivos_fora_da_fiib as $key => $objetivo_instrucao)
                {!! Form::model($objetivo_instrucao, [
                    'method' => 'POST',
                    'route' => ['fiib.inserir_oii', $objetivo_instrucao->id],
                ]) !!}
                <div class="row item-oii text-center">
                    <div class="col-4"><b>OII:</b> {{ $objetivo_instrucao->getOII() }}</div>
                    <div class="col-4"><b>Ref:</b> {{ $objetivo_instrucao->referencia }}</div>
                    <div class="col-4"><button type="submit" class="btn-primary btn">Adicionar <ion-icon
                                name="play-forward"></ion-icon></button></div>
                </div>
                {!! Form::close() !!}
            @endforeach

        </div>

        <div class="col-lg-6 margin-tb card-fff scroll-y">
            <h3 class="text-center">OII dentro da FIIB</h3>
            @foreach ($objetivos_dentro_da_fiib as $key => $objetivo_instrucao)
                {!! Form::model($objetivo_instrucao, [
                    'method' => 'POST',
                    'route' => ['fiib.remover_oii', $objetivo_instrucao->id],
                ]) !!}
                <div class="row item-oii-001eff text-center">
                    <div class="col-4"><b>OII:</b> {{ $objetivo_instrucao->getOII() }}</div>
                    <div class="col-4"><b>Ref:</b> {{ $objetivo_instrucao->referencia }}</div>
                    <div class="col-4"><button type="submit" class="btn-danger btn">Remover <ion-icon name="play-back">
                            </ion-icon></button></div>
                </div>
                {!! Form::close() !!}
            @endforeach
        </div>
    </div>
@endsection
