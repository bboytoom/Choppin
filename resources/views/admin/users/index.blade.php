@extends('layouts.admin_layout')

@section('title', 'Usuarios')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Usuarios</h1>

    <div class="alert alert-warning" role="alert">
        <b>NOTA:</b> Cuando se agrega un nuevo usuario el sistema crea la contraseña <strong>@User2907</strong>  por defecto
    </div>

    <user-component></user-component>

@endsection
