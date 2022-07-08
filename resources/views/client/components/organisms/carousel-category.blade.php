@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel/owl.theme.default.min.css') }}">
@endpush

<div class="categories owl-carousel mt-3">
    @foreach ($category as $item)
        <x-molecules.category-card :path="$item->path" :name="$item->name" width="300px"/>
    @endforeach
</div>
@push('js')
    <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script>
      $(".categories").owlCarousel({
        autoplay:true,
        loop:true,
        margin:10,
        autoHeight:true,
        autoWidth:true,
        center: true,
        singleItem: true,
        responsive:{
            0:{
                items:2,
                center: true,
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
      });
    </script>
@endpush