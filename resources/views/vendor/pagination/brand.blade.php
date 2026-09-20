@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="Pagination">
        <p class="pagination__summary">
            Showing
            <span>{{ $paginator->firstItem() }}</span>
            &ndash;
            <span>{{ $paginator->lastItem() }}</span>
            of
            <span>{{ $paginator->total() }}</span>
            {{ \Illuminate\Support\Str::plural('piece', $paginator->total()) }}
        </p>

        <ul class="pagination__list">
            @if ($paginator->onFirstPage())
                <li class="pagination__item is-disabled" aria-disabled="true">
                    <span class="pagination__link pagination__link--dir" aria-hidden="true">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M15 18l-6-6 6-6"/>
                        </svg>
                    </span>
                </li>
            @else
                <li class="pagination__item">
                    <a class="pagination__link pagination__link--dir" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous page">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M15 18l-6-6 6-6"/>
                        </svg>
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="pagination__item is-disabled" aria-disabled="true">
                        <span class="pagination__link is-ellipsis">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination__item is-active" aria-current="page">
                                <span class="pagination__link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="pagination__item">
                                <a class="pagination__link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="pagination__item">
                    <a class="pagination__link pagination__link--dir" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next page">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M9 6l6 6-6 6"/>
                        </svg>
                    </a>
                </li>
            @else
                <li class="pagination__item is-disabled" aria-disabled="true">
                    <span class="pagination__link pagination__link--dir" aria-hidden="true">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M9 6l6 6-6 6"/>
                        </svg>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif