<x-template.layout title="{{$title}}">
  <x-organisms.navbar cartCount=10 :path="$shop->path"/>
  <x-organisms.products :dataProduct="$category->product">
    <h1 class="pb-4">Category : {!! str_replace('-', ' ', ucwords($category->name)) !!}</h1>
  </x-organisms.products>
  <x-organisms.footer :shop="$shop"/>
</x-template.layout>