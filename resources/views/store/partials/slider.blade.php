<div class="bd-example">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			@foreach( $galeria as $index => $item )
				<li data-target="#carouselExampleCaptions" data-slide-to="{{ $index }}" class="@if($index == 0) active @endif"></li>
			@endforeach
		</ol>
		<div class="carousel-inner">
			@foreach ($galeria as $index => $item)
				<div class="carousel-item @if($index == 0) active @endif">
					<img src="{{ '/gallery_img/'.$item->image }}" class="d-block w-100" alt="{{ $item->image }}">
					
					<div class="carousel-caption d-none d-md-block">
						<h5>{{ $item->title }}</h5>
						<p>{{ $item->description }}</p>
					</div>
				</div>
			@endforeach
		</div>
		<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
    </div>
</div>