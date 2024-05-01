
<nav class="d-flex justify-items-center justify-content-between mx-3">
    <div class="flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
        <div>
            <p class="small" style="color: darkcyan;">
                {!! __('Hiển thị') !!}
                {!! __('bản ghi') !!}
                <span class="fw-bold">{{ $paginator->firstItem() }}</span>
                {!! __('-') !!}
                <span class="fw-bold">{{ $paginator->lastItem() }} </span>
                (
                {!! __('Tổng:') !!}
                <span class="fw-bold">{{ $paginator->total() }} </span>
                {!! __('bản ghi') !!}
                )
            </p>
        </div>
        @if ($paginator->hasPages())
        <div>
            <ul class="pagination pagee">
                {{-- Previous Page Link --}}
                @if (!$paginator->onFirstPage())
                    <li class="page-item">
                        <a class="page-link" href="{{ \Request::url() }}" rel="prev" aria-label="@lang('pagination.first')">Đầu</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="{{ preg_replace('/\?page=[1]$/','',$paginator->previousPageUrl())}}" rel="prev" aria-label="@lang('pagination.previous')"><i class="fa-solid fa-chevron-left"></i></a>
                    </li>
                @endif
                
                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @php
                $array_page = [
                    $paginator->currentPage() - 1,
                    $paginator->currentPage() - 2,
                    $paginator->currentPage() + 1,
                    $paginator->currentPage() + 2,
                    $paginator->lastPage(),
                    $paginator->lastPage()-1
                ]
                @endphp
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @elseif (in_array($page, $array_page))
                            <li class="page-item"><a href="{{ preg_replace('/\?page=[1]$/','',$url)}}" class="page-link">{{ $page }}</a></li>
                        @elseif ($page == $paginator->lastPage() - 2)
                            <li class="page-item disabled"><span class="page-item"><i class="fa fa-ellipsis-h"></i></span></li>
                        @endif
                    @endforeach
                @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="fa-solid fa-chevron-right"></i></a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="{{ \Request::url().'?page='.$paginator->lastPage() }}" rel="next" aria-label="@lang('pagination.last')">Cuối</a>
                    </li>
                @endif
            </ul>
        </div>
        @endif
    </div>
</nav>

<style>
    .pagination {
        float: right;
        margin: 0 0 5px;
    }

    .pagination li {
        margin-left: 3px;
    }

    .pagination li a, .pagination li span {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
        font-weight: bold;
    }

    .pagination li a:hover {
        color: #CB2828;
    }

    .pagination li.active a,
    .pagination li.active a.page-link,
    .pagination li.active span,
    .pagination li.active span.page-link {
        background: darkcyan;
    }

    .pagination li.active a:hover {
        background: #0397d6;
    }

    .pagination li.disabled i {
        color: #ccc;
    }

    .pagination li i {
        font-size: 16px;
    }
</style>