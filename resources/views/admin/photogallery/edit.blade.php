@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Editar imagenes</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            <form action="{{ route('admin.photogallery.update', $gallery) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                {{ method_field('PUT') }}
				{{ csrf_field() }}

                @include('admin.photogallery.form')
            </form>
        </div>
    </div>

@endsection