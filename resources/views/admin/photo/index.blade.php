@extends('layouts.admin_layout')

@section('title', 'Imagenes del product')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Imagenes del producto</h1>
    
    <photo-component :productoid="{{ $id }}"></photo-component>

    <div class="col-md-12 mt-5 text-right">
        <a href="{{route('products.edit', base64_encode($id))}}" type="button" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">
                Regresar
            </span>
        </a>
    </div>

@endsection
