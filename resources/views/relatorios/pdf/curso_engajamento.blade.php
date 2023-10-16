@extends('layouts.app')

@section('content')
<h1 class="title-sipam text-center font-large">
    Militares que não possuem o curso obrigatório para reengajamento
</h1>
@foreach ($subunidades as $subunidade)
    <div class="row relatorio">
        <h2 class="col-12 subtitle-sipam font-large">{{$subunidade->nome}}</h2>
    @php
        $militares = $resultado[$subunidade->nome]
    @endphp
        @foreach ($militares as $militar)
        <div class="col-4 font-small">
            {{$militar->getMilitar()}}
        </div>
        @endforeach
    </div>
    <div class="page_break"></div>
@endforeach

@endsection