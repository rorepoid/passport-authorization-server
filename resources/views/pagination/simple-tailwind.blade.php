@if ($paginator->hasPages())
<div>
    <nav>
        <ul class="flex">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <li aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span
                    class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-gray-900 border-r-0 select-none font-bold"
                    aria-hidden="true"
                >Previous</span>
            </li>
            @else
            <li>
                <a class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 border-r-0 select-none hover:bg-gray-200  font-bold" href="{{ $paginator->previousPageUrl() }}"
                    rel="prev"
                    aria-label="@lang('pagination.previous')">
                    <span>Previous</span>
                </a>
            </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <li class="">
                <a class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 border-r-0 select-none hover:bg-gray-200 font-bold"
                    href="{{ $paginator->nextPageUrl() }}"
                    rel="next"
                    aria-label="@lang('pagination.next')">
                    <span>Next</span>
                </a>
            </li>
            @else
            <li aria-disabled="true" aria-label="@lang('pagination.next')">
                <span
                    class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-gray-900 border-r-0 select-none font-bold"
                    aria-hidden="true"
                >Next</span>
            </li>
            @endif
        </ul>
    </nav>
</div>
@endif
