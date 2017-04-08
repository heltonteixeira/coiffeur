@if ($paginator->hasPages())
    <ul class="pager">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><a>@lang('pagination.previous')</a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="waves-effect">@lang('pagination.previous')</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" class="waves-effect">@lang('pagination.next')</a></li>
        @else
            <li class="disabled"><a>@lang('pagination.next')</a></li>
        @endif
    </ul>
@endif
