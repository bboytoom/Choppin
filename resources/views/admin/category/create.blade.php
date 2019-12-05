@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Crear categoriar</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif
                    
            {!! Form::open(['route'=>'admin.category.store', 'autocomplete' => 'off']) !!}
                
                @include('admin.category.form')

            {!! Form::close() !!}
        </div>
    </div>

@endsection