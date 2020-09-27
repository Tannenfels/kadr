@extends('layouts.app')

@section('content')
    <div id="list-wrapper">
        <div align="left">
            @yield('content')
        </div>
        <div align="right">
            @yield('right-categories')
        </div>
    </div>
@endsection
