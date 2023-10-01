@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Cadastrar Novo Militar</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-white" href="{{ route('militares.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
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


{!! Form::open(array('route' => 'militares.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <div class="row">
                <div class="col-4">
                    <strong>Posto/Graduação:</strong>
                    <select name="posto_id" class="form-select">
                        @foreach ($postos as $key => $posto)
                        <option value="{{$posto->id}}">
                            {{$posto->posto}}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-4">
                    <strong>Número:</strong>
                    {!! Form::number('numero', null, array('placeholder' => 'Número','class' => 'form-control')) !!}
                </div>

                <div class="col-4">
                    <strong>Nome de Guerra:</strong>
                    {!! Form::text('nome_de_guerra', null, array('placeholder' => 'Nome de Guerra','class' => 'form-control')) !!}
                </div>

                <div class="col-8">
                    <strong>Nome:</strong>
                    {!! Form::text('nome', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
                </div>


                <div class="col-4">
                    <strong>Data de Nascimento</strong>
                    <input type="date" name="data_nascimento" class="form-control" id="">
                </div>


                <div class="col-4">
                    <strong>Turma/Ano de Incorporação:</strong>
                    {!! Form::number('turma', null, array('placeholder' => 'Turma','class' => 'form-control', 'min'=> (intval(date('Y')-8)),'max'=>date('Y')),) !!}
                </div>

                <div class="col-4">
                    <strong>Subunidade:</strong>
                    <select name="subunidade_id" class="form-select">
                        @foreach ($subunidades as $key => $subunidade)
                        <option value="{{$subunidade->id}}">
                            {{$subunidade->nome}}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-4">
                    <strong>Pelotão:</strong>
                    <select name="pelotao_id" class="form-select">
                        @foreach ($pelotoes as $key => $pelotao)
                        <option value="{{$pelotao->id}}">
                            {{$pelotao->pelotao}}
                        </option>
                        @endforeach
                    </select>
                </div>


                <div class="col-4">
                    <strong>CPF:</strong>
                    <input class="form-control" placeholder="CPF" type="number" name="cpf">
                </div>

                <div class="col-4">
                    <strong>Identidade Militar:</strong>
                    <input class="form-control" placeholder="Identidade" type="number" name="idt_militar">
                </div>

                <div class="col-4">
                    <strong>Tipo Sanguíneo:</strong>
                    <input class="form-control" placeholder="Ex: O-" type="text" name="tipo_sanguineo">
                </div>

                <div class="col-12">
                    <strong>Endereço:</strong>
                    {!! Form::text('endereco', null, array('placeholder' => 'Ex: Rua, número, bairro, cidade','class' => 'form-control')) !!}
                </div>

                <div class="col-4">
                    <strong>Contato:</strong>
                    {!! Form::text('contato', null, array('placeholder' => 'Contato','class' => 'form-control')) !!}
                </div>

                <div class="col-8">
                    <strong>Nome do Responsável:</strong>
                    {!! Form::text('responsavel', null, array('placeholder' => 'Nome do Responsável','class' => 'form-control')) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">CADASTRAR</button>
    </div>
</div>
{!! Form::close() !!}

@endsection
