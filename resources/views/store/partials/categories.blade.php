<div class="col-md-3 mt-3">
    <ul class="nav flex-column">
        <div class="bg-light list-group-item categorias--mdf">
            <h4>Categorias</h4>
        </div>

        @foreach ($categories as $item)
            <li class="list-group-item categorias--mdf">
                <a class="text-secondary" href="{{ route('category-product', $item->id) }}">
                    {{ $item->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
