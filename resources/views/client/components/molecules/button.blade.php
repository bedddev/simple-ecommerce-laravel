<div class="text-{{ $align }}">
    <a href="{{ $link }}" class="btn btn-{{$size}} btn-{{ $type }} rounded-pill fw-bold p-md-3 p-2 px-3">
        <div class="d-flex align-items-center gap-3">
        {{ $text }}
        @if ($arrow)
            <i class="bi {{ $icon }}"></i>
        @endif
        </div>
    </a>
</div>