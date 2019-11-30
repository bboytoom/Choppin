@extends('admin.template')

@section('content')

    <section class="row">
        <div class="col-md-12">
            <h1>
				<i class="fa fa-shopping-cart"></i> PRODUCTOS 
				<a href="{{ route('admin.product.create') }}" class="btn btn-warning">
					<i class="fa fa-plus-circle"></i> Productos
				</a>
			</h1>
        </div>

        <div class="col-md-12 mt-5">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Caracteristicas</th>
                        <th class="text-center">Editar</th>
                        <th class="text-center">Eliminar</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Visible</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
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
                            <td><img src="{{ $product->image }}" width="40"></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>${{ number_format($product->price,2) }}</td>
                            <td>{{ $product->visible == 1 ? "Si" : "No" }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection