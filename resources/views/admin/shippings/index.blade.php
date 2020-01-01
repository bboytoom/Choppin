@extends('layouts.admin_layout')

@section('title', 'Direcciones de envio')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Direcciones de envio</h1>
    
    <shipping-component :userid="{{ $id }}"></shipping-component>

    <div class="col-md-12 mt-5 text-right">
        <a href="{{route('users.edit', base64_encode($id))}}" type="button" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">
                Regresar
            </span>
        </a>
    </div>
@endsection
