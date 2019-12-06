@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Agregar caracteristicas</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            <form action="{{ route('admin.characteristics.store') }}" method="POST" autocomplete="off">
                {{ csrf_field() }}

                <input type="hidden" name="producto_id" value="{{ $producto_id }}">
                @include('admin.characteristics.form')
            </form>
        </div>
    </div>

@endsection