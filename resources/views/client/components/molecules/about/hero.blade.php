@push('css')
    <style>
        .about-text h4{
          font-weight: 300;
          width: 80%;
          margin: 0 auto;
        }

        .img-about-us img{
          width: 100%;
        }

        @media screen and (max-width:576px){
            .about-text h4{
                font-weight: 300;
                width: 100%;
                margin: 0 auto;
                font-size: 16px;
            }
        }
    </style>
@endpush

<div class="py-md-5 py-2">
    <div class="container about-text">
    <h1 class="font-primary text-center mt-5">About Us</h1>
    <h4 class="font-secondary text-center">{{$shop->desc}}</h4>
    </div>

    <div class="img-about-us mt-4">
    <img src="{{ asset('assets/images/about-us-lg.png') }}" alt="" class="img-fluid">
    </div>
</div>