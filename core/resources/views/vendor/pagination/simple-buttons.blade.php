@if ($paginator->hasPages())
    <div class="simple-pagination">
        {{-- Previous Button --}}
        @if ($paginator->onFirstPage())
            <span class="simple-prev simple-disabled" aria-disabled="true">
                <i class="bi bi-chevron-left"></i> Previous
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="simple-prev" rel="prev">
                <i class="bi bi-chevron-left"></i> Previous
            </a>
        @endif

        {{-- Next Button --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="simple-next" rel="next">
                Next <i class="bi bi-chevron-right"></i>
            </a>
        @else
            <span class="simple-next simple-disabled" aria-disabled="true">
                Next <i class="bi bi-chevron-right"></i>
            </span>
        @endif
    </div>
@endif
