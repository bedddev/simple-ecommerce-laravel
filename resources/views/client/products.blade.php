<x-template.layout title="{{$title}}">
  <x-organisms.navbar cartCount=10 :path="$shop->path"/>
  <x-organisms.carousel-category :category="$category" />
  <x-organisms.products :dataProduct="$product">
    <h1 class="text-center pb-5">Recent Product</h1>
    <x-slot:productCTA>
      <div class="pt-5">
        {{ $product->links('vendor.pagination.bootstrap-5') }}
      </div>
    </x-slot:productCTA>
  </x-organisms.products>
  <x-organisms.footer :shop="$shop"/>
</x-template.layout>