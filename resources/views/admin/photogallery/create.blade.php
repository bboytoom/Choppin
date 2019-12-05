@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Crear imagenes</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif
                    
            {!! Form::open(['route'=>'admin.photogallery.store', 'files' => true, 'autocomplete' => 'off']) !!}
                
                @include('admin.photogallery.form')

            {!! Form::close() !!}
        </div>
    </div>

@endsection