@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Editar imagenes</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif
                    
            {!! Form::model($gallery, array('route' => array('admin.photogallery.update', $gallery), 'files' => true, 'autocomplete' => 'off')) !!}
                <input type="hidden" name="_method" value="PUT">
             
                @include('admin.photogallery.form')

            {!! Form::close() !!}
        </div>
    </div>

@endsection