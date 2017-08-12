@extends('layouts.app')

@section('content')
    <product server="{{ \Illuminate\Support\Facades\Session::get('esim_server', 'harmonia') }}"></product>
@endsection
