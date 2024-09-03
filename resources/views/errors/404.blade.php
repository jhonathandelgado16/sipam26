{{-- @extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found')) --}}

@extends('layouts.app')

@section('content')
    <div class="col-12 d-flex align-items-center heigth-100 text-center" style="background-color: rgb(205, 0, 0)">
        <div class="row">
            <h1 style="color: rgb(255, 255, 255); font-size: 100px;"><ion-icon name="warning"></ion-icon></h1>
            <h1 style="color: rgb(255, 255, 255)">Erro 404 | A página que você tentou acessar não existe!</h1>
        </div>
    </div>
@endsection
