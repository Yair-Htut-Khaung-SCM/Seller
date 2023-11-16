@if ($paginator->hasPages())
    <nav >
        <div class="d-flex justify-content-center flex-fill d-lg-none">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link theme_green pagi" style="border-radius: 50%; background-color: #ffffff; width: 43px; height: 43px; text-align:center;"><i class="bi bi-chevron-left"></i></i></span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link theme_green pagi" style="border-radius: 50%; background-color: #ffffff; width: 43px; height: 43px; text-align:center;" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="bi bi-chevron-left"></i></i></a>
                    </li>
                @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled " aria-disabled="true">
                                <span class="page-link" style="border:0px; background-color: #f8f9fa;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots theme_green" viewBox="0 0 16 16">
                                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                    </svg>
                                </span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item " aria-current="page"><span class="page-link theme_green" style="background-color: #12ca8a !important; color:aliceblue; border-radius: 50%; width: 43px; height: 43px; text-align:center;">{{ $page }}</span></li>
                                @else
                                    <li class="page-item "><a class="page-link theme_green pagi" style="border-radius:50%; width: 43px; height: 43px; text-align:center;" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link theme_green pagi" style="border-radius: 50%; background-color: #ffffff; width: 43px; height: 43px; text-align:center;" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="bi bi-chevron-right"></i></i></a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link theme_green pagi" style="border-radius: 50%; background-color: #ffffff; width: 43px; height: 43px; text-align:center;"><i class="bi bi-chevron-right"></i></i></span>
                    </li>
                @endif
            </ul>
        </div>
            <!-- <div class="d-flex justify-content-between flex-fill d-sm-none">
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">@lang('pagination.previous')</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                        </li>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">@lang('pagination.next')</span>
                        </li>
                    @endif
                </ul>
            </div> -->

            <!-- <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="small text-muted">
                    {!! __('Showing') !!}
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div> -->

            <div class="d-lg-flex justify-items-center justify-content-center none d-sm-none d-none">
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link me-2 px-3" style="border-radius: 50%; background-color: #ffffff; width: 43px; height: 43px; text-align:center;" aria-hidden="true">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link theme_green me-2 px-3 pagi" style="border-radius: 50%; width: 43px; height: 43px; text-align:center;" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled me-1" aria-disabled="true">
                                <span class="page-link" style="border:0px; background-color: #f8f9fa;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots theme_green" viewBox="0 0 16 16">
                                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                    </svg>
                                </span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item me-2" aria-current="page"><span class="page-link theme_green" style="background-color: #12ca8a !important; color:aliceblue; border-radius: 50%; width: 43px; height: 43px; text-align:center;">{{ $page }}</span></li>
                                @else
                                    <li class="page-item me-2"><a class="page-link theme_green pagi" style="border-radius:50%; width: 43px; height: 43px; text-align:center;" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link theme_green px-3 pagi" style="border-radius: 50%; width: 43px; height: 43px; text-align:center;" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled theme_green"  aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link px-3 disable" style="border-radius: 50%; background-color: #ffffff; width: 43px; height: 43px; text-align:center;" aria-hidden="true">&rsaquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
    </nav>
@endif
