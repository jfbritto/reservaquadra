@extends('adminlte::master')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('body')

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
