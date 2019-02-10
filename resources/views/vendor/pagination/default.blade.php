@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
            <li class="disabled"><a href="{{ $paginator->url(1) }}">Pertama</a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            <li><a href="{{ $paginator->url(1) }}">Pertama</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            @php
                $limit = 2;
                $first_count = 0;
                $last_count = 0;
            @endphp

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)

                    {{-- Page Before Current Paginator --}}
                    @if (((($paginator->currentPage() - $page) <= $limit) and ($page < $paginator->currentPage()) and $first_count != $limit))
                        <? $first_count++; ?>   
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif

                    {{-- Current Paginator --}}
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @endif

                    {{-- Page After Current Paginator --}}
                    @if (((($page - $paginator->currentPage()) <= $limit) and ($page > $paginator->currentPage()) and $last_count != $limit))
                        <? $last_count++; ?>   
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->url($paginator->lastPage()) }}">Terakhir</a></li>
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><a href="{{ $paginator->url($paginator->lastPage()) }}">Terakhir</a></li>
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
@endif
