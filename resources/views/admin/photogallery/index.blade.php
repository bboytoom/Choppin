@extends('admin.template')

@section('content')

    <section class="row">
        <div class="col-md-12">
            <h1>
				<i class="fa fa-shopping-cart"></i> IMAGENES 
				<a href="{{ route('admin.photogallery.create') }}" class="btn btn-warning">
				<i class="fa fa-plus-circle"></i> Imagenes</a>
			</h1>
        </div>

        <div class="col-md-12 mt-5">
            <table class="table table-striped table-hover">
				<thead>
					<tr>
                        <th>Editar</th>
                        <th>Eliminar</th>
						<th>Titulo</th>
						<th>Imagen</th>
						<th>Estatus</th>
					</tr>
				</thead>
				<tbody>
					@foreach($photos as $photo)
						<tr>
							<td>
                                <a href="{{ route('admin.photogallery.edit', $photo) }}" class="btn btn-primary">
									<i class="fas fa-edit"></i>
								</a>
							</td>
							<td>
								{!! Form::open(['route' => ['admin.photogallery.destroy', $photo]]) !!}
									<input type="hidden" name="_method" value="DELETE">
									<button onClick="return confirm('Eliminar registro?')" class="btn btn-danger">
										<i class="fas fa-trash-alt"></i>
									</button>
								{!! Form::close() !!}
							</td>
							<td>{{ $photo->title }}</td>
							<td><img src="{{'/gallery_img/'.$photo->image }}" width="40"></td>
                            <td>{{ $photo->status }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
        </div>
    </section>

@endsection