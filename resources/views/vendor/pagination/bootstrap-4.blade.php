@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled theme_green" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link theme_green" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item theme_green">
                    <a class="page-link theme_green" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled theme_green" aria-disabled="true"><span class="page-link theme_green">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item" aria-current="page"><span class="page-link" style="background-color: #259e71 !important; color:aliceblue;">{{ $page }}</span></li>
                        @else
                            <li class="page-item theme_green"><a class="page-link theme_green" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item theme_green">
                    <a class="page-link theme_green" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled theme_green" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link theme_green" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
