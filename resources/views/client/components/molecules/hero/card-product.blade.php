@foreach ($dataImage->take(1) as $image)
    <div class="hero-product" style="background-image: url({{ asset('shop/products/'. $image->path ) }})">
@endforeach
<div class="d-flex flex-column justify-content-between">
    <p class="text-white fw-bolder">{!! str_replace('-', ' ', ucwords($title)) !!} </p>
    <x-molecules.button arrow="true" type="light" icon="bi-arrow-right" align="end" link="{{ route('clientProductDetail', $title) }}"/>
</div>
</div>