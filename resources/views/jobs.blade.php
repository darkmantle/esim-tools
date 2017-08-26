@extends('layouts.app')

@section('content')
    <jobs server="{{ \Illuminate\Support\Facades\Session::get('esim_server', 'harmonia') }}"></jobs>
@endsection
