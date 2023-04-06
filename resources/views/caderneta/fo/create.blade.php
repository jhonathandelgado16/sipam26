@extends('layouts.app')

@section('content')

<div class="row margin-bottom-15">
    <div class="pull-right col-8">
        <a class="btn btn-white" href="{{ route('caderneta.ficha' , $militar->id) }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
    </div>
</div>

<div class="row margin-bottom-10">
    <div class="col-lg-12 margin-tb">
        <div class="row">
            <h2 class="title-caderneta">Cadastrar Fato Observado</h2>
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


            {!! Form::open(array('route' => 'fo.store','method'=>'POST')) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                            <strong>Fato Observado:</strong>
                            <select name="fato_observado" class="form-select text-center" required>
                                <option value="FO+">
                                    FO+
                                </option>
                                <option value="FO-">
                                    FO-
                                </option>
                            </select>
                        </div>

                        <div class="col-6">
                            <strong>Militar que observou o fato:</strong>
                            {!! Form::text('militar_que_observou', null, array('placeholder' => 'Ex: 3º Sgt CAVEIRA','class' => 'form-control')) !!}
                        </div>

                        <div class="col-4">
                            <strong>Data do Fato Observado:</strong>
                            <input name="data_lancamento" type="date" value="{{date('Y-m-d')}}" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <strong>Descrição do Fato Observado:</strong>
                            <textarea name="descricao" class="form-control" placeholder="Ex: Por estar com o coturno sujo" required></textarea>
                        </div>

                        <input name="id_militar" type="number" value="{{$militar->id}}" class="d-none">

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
