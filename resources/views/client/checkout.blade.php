<x-template.layout title="{{ $title }}" >
  <x-organisms.navbar :path="$shop->path"/>
  <div class="container mt-3">
    <h2>Checkout</h2>
    <hr/>
  </div>
  <x-organisms.carts />
  <x-organisms.checkout-form />
  <x-organisms.footer :shop="$shop"/>
</x-template.layout>