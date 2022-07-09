<x-template.layout title="{{ $title }}" >
  <x-organisms.navbar :path="$shop->path"/>
    <div class="container py-y d-flex flex-column align-items-center gap-3">
      <img src="{{ asset('client/img/success-order.png') }}" class="border rounded rounded-3" style="width:40%;height:auto;">
      <div class="text-center">
        <h4>Thank you so much for your order</h4>
        <p>Order Code : <u><b class="text-danger">{{ $order_code }}</b></u></p>
        <p>You can always track your orders in the <a href="{{ route('clientCheckOrder') }}"><u>Check Order</u></a>, please keep and don't forget this code for check status order.</p>
      </div>
      <a href="{{ route('clientCheckOrder') }}" class="btn btn-primary">Check Order Now</a>
    </div>
  <x-organisms.footer :shop="$shop"/>
</x-template.layout>