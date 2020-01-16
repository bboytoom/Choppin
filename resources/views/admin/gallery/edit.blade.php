@extends('layouts.admin_layout')

@section('title', 'Imagenes de la galeria')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Imagenes de la galeria {{ $name }}</h1>
    
    <!--photo-component :galleryid="{{ $id }}"></photo-component-->

    <div class="col-md-12 mt-5 text-right">
        <a href="{{ route('galleries.index') }}" type="button" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">
                Regresar
            </span>
        </a>
    </div>

@endsection
