@push('css')
    <style>
         .product-title{
            font-size:1.2rem;
            display: -webkit-box;
            overflow: hidden;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            height:3.5rem;
            transition: 0.2s cubic-bezier(0.57, 0, 0.06, 0.95);
        }

        .card:hover{
            transition: 0.2s cubic-bezier(0.57, 0, 0.06, 0.95);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
        
        @media screen and (max-width: 767px){
            .product-title{
                font-size:1rem;
            }
        }
    </style>
@endpush

<div class="container py-5">
    {{ $slot }}
    <div class="row g-3">
        @foreach ($dataProduct as $item)
            <x-molecules.product-card :image="$item->productImage" :category="$item->category->name" :title="$item->title" :price="$item->price"/>
        @endforeach
    </div>
    {{ $productCTA ?? '' }}
</div>