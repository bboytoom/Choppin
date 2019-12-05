@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Editar articulos</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (count($errors) > 0)
                @include('admin.partials.errors')
            @endif

            {!! Form::model($product, array('route' => array('admin.product.update', $product->slug), 'files' => true, 'autocomplete' => 'off')) !!}

                <input type="hidden" name="_method" value="PUT">

                @include('admin.product.form')

            {!! Form::close() !!}
        </div>
    </div>

@endsection