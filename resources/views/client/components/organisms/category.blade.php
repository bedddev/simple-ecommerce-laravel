<div class="container py-5">
    <h1 class="text-center py-4">Category</h1>
    <div class="row mb-4 g-md-4 g-3">
        @foreach ($dataCategory as $item)
            <div class="col-md-6 col-6">
                <x-molecules.category-card :path="$item->path" :name="$item->name" />
            </div>
        @endforeach
    </div>
    {{ $slot }}
</div>