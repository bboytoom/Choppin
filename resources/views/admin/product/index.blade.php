@extends('admin.template')

@section('content')

    <h1 class="h3 mb-2 text-gray-800 mb-4">Articulos</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-right">
                <a href="{{ route('admin.product.create') }}">
                    <i class="fa fa-plus-circle"></i> Agregar productos
                </a>
            </h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Visible</th>
                            <th>Caracteristicas</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td><img src="{{'/products_img/'.$product->image }}" width="40"></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>${{ number_format($product->price,2) }}</td>
                                <td>{{ $product->visible == 1 ? "Si" : "No" }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.characteristics.show', $product->id) }}" class="btn btn-success">
                                        <i class="fas fa-wrench"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.product.edit', $product->slug) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    {!! Form::open(['route' => ['admin.product.destroy', $product->slug]]) !!}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button onClick="return confirm('Eliminar registro?')" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection