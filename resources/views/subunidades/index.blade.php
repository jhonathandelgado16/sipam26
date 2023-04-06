@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
    <div class="row">
        <div class="pull-left col-8">
            <h2>Controle de Subunidades</h2>
        </div>

        <div class="col-lg-12 margin-tb">
            <div class="row">
                <div class="pull-right col-8">
                    <a class="btn btn-white" href="{{ route('admins.index') }}"><img src="{{url('storage/icons/back.png')}}" height="20"> Voltar</a>
                </div>
                <div class="row justify-content-end col-4">
                    @can('subunidade-create')
                        <a class="col-7 btn btn-primary" href="{{ route('subunidades.create') }}"> Adicionar Subunidade</a>
                    @endcan
                </div>
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

<table class="table text-center">
    <tr>
        <th>Subunidade</th>
        <th>Cmt Subunidade</th>
        <th width="280px">Ações</th>
    </tr>

    @foreach ($data as $key => $subunidade)
    <tr>
        <td>{{ $subunidade->nome }}</td>
        <td>{{ $subunidade->cmt_subunidade }}</td>
        <td>
            @can('subunidade-edit')
                <a class="btn btn-white" href="{{ route('subunidades.edit',$subunidade->id) }}"><img src="{{url('storage/icons/edit.png')}}" height="20"> Editar</a>
            @endcan
        </td>
    </tr>
    @endforeach
</table>


{!! $data->render() !!}

@endsection
