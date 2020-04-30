@if ($paginator->hasPages())
    <div class="m-auto flex overflow-y-auto">
        <nav class="bg-white w-auto">
            <ul class="flex flex-row">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span
                            class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-gray-900 border-r-0 select-none"
                            aria-hidden="true"
                        >Previous</span>
                    </li>
                @else
                    <li>
                        <a class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 border-r-0 select-none hover:bg-gray-200" href="{{ $paginator->previousPageUrl() }}"
                            rel="prev"
                            aria-label="@lang('pagination.previous')">
                            <span>Previous</span>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li aria-disabled="true">
                            <span class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 border-r-0 select-none hover:bg-gray-200">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li aria-current="page" class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 border-r-0 bg-gray-400 select-none">
                                    <span>{{ $page }}</span>
                                </li>
                            @else
                                <li>
                                    <a class="relative block leading-tight bg-white border border-gray-300 text-blue-700 border-r-0 hover:bg-gray-200 h-full flex content-center" href="{{ $url }}"><span class="py-2 px-3">{{ $page }}</span></a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="">
                        <a class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 border-r-0 select-none hover:bg-gray-200"
                            href="{{ $paginator->nextPageUrl() }}"
                            rel="next"
                            aria-label="@lang('pagination.next')">
                            <span>Next</span>
                        </a>
                    </li>
                @else
                    <li aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span
                            class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-gray-900 border-r-0 select-none"
                            aria-hidden="true"
                        >Next</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
