@if ($paginator->hasPages())

    <style>
        .pagination{
            display: flex;
            gap: .5rem;
            height: 50px;
        }

        .pagination li{
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #C83C3C;
            background: #C83C3C;
            color: #FFFF;
            font-weight: bolder;
            padding: .8rem;
            width: 100%;
            height: 100%;
        }

        .pagination li a{
            display: block;
            align-items: center;
            justify-content: center;
        }

        #stopNextPrevious{
            display: none;
            background-color: transparent !important;
            border: transparent !important;
        }
    </style>
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" id="stopNextPrevious" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span id="stopNextPrevious" aria-hidden="true"></span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><img width="100%" src="{{asset('images/icons/seta-esquerda.svg')}}" alt=""></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><img width="100%" src="{{asset('images/icons/seta-direita.svg')}}" alt=""></a>
                </li>
            @else
                <li class="disabled" id="stopNextPrevious" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span id="stopNextPrevious" aria-hidden="true"></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
