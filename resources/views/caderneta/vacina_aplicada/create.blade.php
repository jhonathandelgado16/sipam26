@extends('layouts.app')

@section('content')

<div class="row margin-bottom-15">
    <div class="pull-right col-8">
        <a class="btn btn-white" href="{{ route('caderneta.ficha' , $militar->id) }}"><img
                src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
    </div>
</div>

<div class="row margin-bottom-10">
    <div class="col-lg-12 margin-tb">
        <div class="row">
            <h2 class="title-caderneta">Cadastrar aplicação de Vacina</h2>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-12 row margin-bottom-10">
        <div class="row card-fo justify-content-center">
            <div class="col-2 row justify-content-center">
                <img class="col-md-6" src="{{url('storage/caveira.png')}}">
            </div>
            <div class="col-10 row">
                <h3 class="text-center">{{$militar->getMilitar()}}</h3>
                <div class="row">
                    <h4 class="col text-center">Fração: {{$militar->pelotao->pelotao}}</h4>
                    <h4 class="col text-center">Subunidade: {{$militar->subunidade->nome}}</h4>
                </div>
            </div>

        </div>
    </div>


    {!! Form::open(array('route' => 'vacina_aplicada.store','method'=>'POST')) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <div class="row">

                    <div class="col-6">
                        <strong>Vacina:</strong>
                        <select name="vacina_id" class="form-select">
                            @foreach ($vacinas as $key => $vacina)
                            <option value="{{$vacina->id}}">
                                {{$vacina->vacina}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="offset-2 col-4">
                        <strong>Data da Aplicação:</strong>
                        <input name="data_aplicacao" type="date" value="{{date('Y-m-d')}}" class="form-control" required>
                    </div>

                    <input name="militar_id" type="number" value="{{$militar->id}}" class="d-none">

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Adicionar</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

</div>
@endsection
