@extends('admin.template')

@section('content')
    
    <h1 class="h3 mb-2 text-gray-800 mb-4">Agregar articulos</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            <form action="{{ route('admin.product.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                @include('admin.product.form')
            </form>
        </div>
    </div>

@endsection