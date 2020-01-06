@extends('layouts.admin_layout')

@section('title', 'Administradores')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Administradores</h1>

    <div class="alert alert-warning" role="alert">
        <b>NOTA:</b> Cuando se agrega un nuevo administrador el sistema crea la contraseña <strong>@Admin2907</strong>  por defecto
    </div>

    <admin-component></admin-component>    

@endsection
