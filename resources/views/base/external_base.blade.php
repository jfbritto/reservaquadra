@extends('adminlte::master')

@section('meta_tags')
    <link rel="icon" href="/img/tennis-ball.png" type="image/png">
@stop

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('body')

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/home"><img id="animate" src="/img/logo.png" alt="" style="width: 130px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            @if(auth()->user())
                <li class="nav-item active">
                    <a class="nav-link" style="color: black" href="/home">Entrar</a>
                </li>
            @else
                <li class="nav-item active">
                    <a class="nav-link" style="color: black" href="/">Logar</a>
                </li>
            @endif
            
            <!-- <li class="nav-item">
                <a class="nav-link" style="color: black" href="/reservar">Reservar Horário</a>
            </li> -->

            </ul>
        </div>
    </nav>

    {{-- Content Header --}}
    <div class="content-header">
        <div class="">
            @yield('content_header')
        </div>
    </div>

    {{-- Main Content --}}
    <div class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>


@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
