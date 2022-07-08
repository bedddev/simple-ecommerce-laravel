<x-template.layout title="{{$title}}">
  <x-organisms.navbar cartCount=10 :path="$shop->path"/>
  <x-organisms.category :dataCategory="$category">
    {{ $category->links('vendor.pagination.bootstrap-5') }}
  </x-organisms.category>
  <x-organisms.footer :shop="$shop"/>
</x-template.layout>