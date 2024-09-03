@extends('layouts.app')

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="col-12 row justify-content-center">
        <div class="row">
            <h2 class="font-large title-sipam col-12">Militares aguardando avaliação</h2>
        </div>
        @if (!$militares_sem_avaliacao->isEmpty())
            <div class="col-12 row">
                @foreach ($militares_sem_avaliacao as $militar)
                    <div class="col-4 margin-bottom-5 justify-content-center padding-5">
                        <div class="row card-sipam card-avaliacao margin-side-5">
                            <div class="col-4">
                                <div class="row justify-content-center">
                                    <img class="col-md-10" src="{{ url('storage/perfil.png') }}">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <h3 class="text-center font-small">{{ $militar->getMilitar() }}</h3>
                                    <a class="btn btn-primary font-small"
                                        href="{{ route('avaliacao.realizar', $militar->id) }}">Realizar avaliação <ion-icon
                                            name="list-circle"></ion-icon></a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

    @if (!$militares_com_avaliacao->isEmpty())
        <div class="col-12 row justify-content-center">
            <div class="row">
                <h2 class="font-large title-sipam col-12">Militares com avaliação aguardando aprovação</h2>
            </div>
            <div class="col-12 row">
                @foreach ($militares_com_avaliacao as $avaliacao)
                    <div class="col-4 margin-bottom-5 justify-content-center padding-5">
                        <div class="row card-sipam card-avaliacao margin-side-5">
                            <div class="col-4">
                                <div class="row justify-content-center">
                                    <img class="col-md-10" src="{{ url('storage/perfil.png') }}">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="row justify-content-end">
                                    <h3 class="text-center font-small">{{ $avaliacao->militar->getMilitar() }}</h3>
                                    <h2 class="col-10 font-medium">Nota final: <b
                                            class="font-x-large">{{ $avaliacao->nota_final }}</b></h3>
                                        <a class="col-6 btn btn-primary font-small"
                                            href="{{ route('avaliacao.edit', $avaliacao->militar->id) }}">Editar
                                            <ion-icon name="create"></ion-icon></a>
                                        <a class="col-6 btn btn-primary font-small"
                                            href="{{ route('avaliacao.aprovar', $avaliacao->militar->id) }}">Aprovar
                                            <ion-icon name="checkmark-circle"></ion-icon></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if (!$militares_avaliacao_aprovada->isEmpty())
        <div class="col-12 row justify-content-center">
            <div class="row">
                <h2 class="font-large title-sipam col-12">Militares com avaliação concluída</h2>
            </div>
            <div class="col-12 row">
                @foreach ($militares_avaliacao_aprovada as $avaliacao)
                    <div class="col-4 margin-bottom-5 justify-content-center padding-5">
                        <div class="row card-sipam card-avaliacao margin-side-5">
                            <div class="col-4">
                                <div class="row justify-content-center">
                                    <img class="col-md-10" src="{{ url('storage/perfil.png') }}">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="row justify-content-end">
                                    <h3 class="text-center font-small">{{ $avaliacao->militar->getMilitar() }}</h3>
                                    <h2 class="col-10 font-medium">Nota final: <b
                                            class="font-x-large">{{ $avaliacao->nota_final }}</b></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
