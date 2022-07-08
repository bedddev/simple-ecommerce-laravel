<div class="col-md-3 col-6">
    <a href="{{ route('clientProductDetail', $title) }}">
        <div class="card mb-0">
            <div class="card-content">
                @foreach ($image->take(1) as $item)
                    <img src="{{ asset('shop/products/'. $item->path) }}" alt="" class="card-img-top img-fluid">
                @endforeach
                <div class="card-body p-md-3 p-2">
                    <p class="mb-0"><small>{!! str_replace('-', ' ', ucwords($category)) !!}</small></p>
                    <p class="fw-bolder product-title mb-1">{!! str_replace('-', ' ', ucwords($title)) !!}</p>
                    <p>$ {{ $price }}</p>
                </div>
            </div>
        </div>
    </a>
</div>