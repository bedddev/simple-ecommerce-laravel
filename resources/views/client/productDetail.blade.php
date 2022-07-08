<x-template.layout title="{{ $title }}" >
  <x-organisms.navbar cartCount=10 :path="$shop->path"/>
    <div class="container pt-md-5 pt-3">
      <x-organisms.product-detail :dataProduct="$product" />
    </div>
    <x-organisms.products :dataProduct="$recomendationProducts">
    <h1 class="pb-3 mt-2">Recent Popular Product</h1>
    <x-slot:productCTA>
      <div class="pt-5">
        <x-molecules.button text="More products" align="center" icon="bi-arrow-right" arrow="true" link="{{ route('clientProducts') }}"  />
      </div>
    </x-slot:productCTA>
  </x-organisms.products>
  <x-organisms.footer :shop="$shop"/>
</x-template.layout>