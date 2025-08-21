@if ($paginator->hasPages())
<div class="row">
    <div class="col-lg-12">
        <div class="product__pagination">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <span>&laquo;</span>
            @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <span>{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <a class="active" href="#">{{ $page }}</a>
            @else
            <a href="{{ $url }}">{{ $page }}</a>
            @endif
            @endforeach
            @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
            @else
            <span>&raquo;</span>
            @endif

        </div>
    </div>
</div>
@endif