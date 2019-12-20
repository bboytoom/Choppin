@extends('layouts.admin_layout')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Usuarios</h1>

    <div id="app">
        <user-component></user-component>
        @include('admin.users.edit')
    </div>

@endsection
