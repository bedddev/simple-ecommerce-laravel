<x-template.layout title="{{$title}}">
  <x-organisms.navbar cartCount=10 :path="$shop->path"/>
  <x-molecules.about.hero :shop="$shop"/>
  <x-molecules.about.address />
  <x-molecules.about.shipping-returns />
  <x-molecules.about.warranty />
  <x-molecules.about.f-a-q />
  <x-organisms.footer :shop="$shop"/>
</x-template.layout>