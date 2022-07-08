@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/images-product-slider/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/images-product-slider/easyzoom.css') }}">
    <link rel="stylesheet" href="{{ asset('client/components/molecules/product-detail/product-images/style.css') }}">
@endpush

<div>
    <div class="product__carousel">
        <div class="swiper-container gallery-top">
          <div class="swiper-wrapper">
            @foreach($dataProductimages as $row)
              <div class="swiper-slide easyzoom easyzoom--overlay">
                <a href="{{ asset('shop/products/'.$row->path)}}">
                  <img src="{{ asset('shop/products/'.$row->path)}}">
                </a>
              </div>
            @endforeach
          </div>

          <div class="swiper-button-next swiper-button-white"></div>
          <div class="swiper-button-prev swiper-button-white"></div>
        </div>

        <div class="swiper-container gallery-thumbs">
          <div class="swiper-wrapper">
            @foreach($dataProductimages as $row)
              <div class="swiper-slide">
                <img src="{{ asset('shop/products/'.$row->path)}}">
              </div>
            @endforeach
          </div>
        </div>
      </div>
</div>

@push('js')
    <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/images-product-slider/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/images-product-slider/easyzoom.js') }}"></script>
    <script src="{{ asset('client/components/molecules/product-detail/product-images/main.js') }}"></script>
@endpush