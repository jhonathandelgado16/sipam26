@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Editar Militar</h2>
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

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


{!! Form::model($militar, ['method' => 'PATCH','route' => ['militares.update', $militar->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <strong>Posto/Graduação:</strong>
                    <select name="posto_id" class="form-select">
                        @foreach ($postos as $key => $posto)
                            @if($militar->posto_id == $posto->id)
                                <option value="{{$posto->id}}" selected>
                                    {{$posto->posto}}
                                </option>
                            @else
                                <option value="{{$posto->id}}">
                                    {{$posto->posto}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-2">
                    <strong>Situação:</strong>
                    <select name="situacao" class="form-select">
                            @if($militar->situacao == 'ativa')
                                <option value="ativa" selected>
                                    Ativa
                                </option>
                                <option value="inativo">
                                    Inativo
                                </option>
                            @else
                                <option value="ativa">
                                    Ativa
                                </option>
                                <option value="inativo" selected>
                                    Inativo
                                </option>
                            @endif
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

                <div class="col-12">
                    <strong>Nome:</strong>
                    {!! Form::text('nome', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
                </div>

                <div class="col-6">
                    <strong>Subunidade:</strong>
                    <select name="subunidade_id" class="form-select">
                        @foreach ($subunidades as $key => $subunidade)
                            @if($militar->subunidade_id == $subunidade->id)
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

                <div class="col-6">
                    <strong>Pelotão:</strong>
                    <select name="pelotao_id" class="form-select">
                        @foreach ($pelotoes as $key => $pelotao)
                            @if($militar->pelotao_id == $pelotao->id)
                                <option value="{{$pelotao->id}}" selected>
                                    {{$pelotao->pelotao}}
                                </option>
                            @else
                                <option value="{{$pelotao->id}}">
                                    {{$pelotao->pelotao}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-3">
                    <strong>CPF:</strong>
                    <input class="form-control" value="{{$militar->cpf}}" placeholder="CPF" type="number" name="cpf" maxlength="11" minlength="11">
                </div>

                <div class="col-3">
                    <strong>Identidade:</strong>
                    <input class="form-control" value="{{$militar->idt_militar}}" placeholder="Identidade" type="number" name="idt_militar" maxlength="11" minlength="11">
                </div>

                <div class="col-3">
                    <strong>Data de Nascimento:</strong>
                    <input class="form-control" placeholder="" type="date" name="data_nascimento" value="{{date('Y-m-d')}}">
                </div>

                <div class="col-3">
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
        <button type="submit" class="btn btn-primary">EDITAR</button>
    </div>
</div>
{!! Form::close() !!}

@endsection
