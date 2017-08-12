@extends('layouts.app')

@section('content')

    <exchange server="{{ \Illuminate\Support\Facades\Session::get('esim_server', 'harmonia') }}"></exchange>
@endsection
