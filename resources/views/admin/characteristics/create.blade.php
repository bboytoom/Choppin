@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Agregar caracteristicas</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::open(['route'=>'admin.characteristics.store', 'autocomplete' => 'off']) !!}
                <input type="hidden" name="producto_id" value="{{ $producto_id }}">
                
                @include('admin.characteristics.form')

            {!! Form::close() !!}
        </div>
    </div>

@endsection