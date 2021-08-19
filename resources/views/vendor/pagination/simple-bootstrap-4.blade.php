@if ($paginator->hasPages())
    <nav aria-label="Paginate">
        {{-- <ul class="pagination"> --}}
        <div class="clearfix">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                {{-- <li class="page-item disabled" aria-disabled="true"> --}}
                    {{-- <span class="page-link">@lang('pagination.previous')</span> --}}
                    <span class="btn btn-primary float-left">← Nuevas Publicaciones</span>
                {{-- </li> --}}
            @else
                {{-- <li class="page-item"> --}}
                    <a class="btn btn-primary float-left" href="{{ $paginator->previousPageUrl() }}" rel="prev"> ← Nuevas Publicaciones <!--&rarr;--></a>
                    {{-- <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a> --}}
                {{-- </li> --}}
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                {{-- <li class="page-item"> --}}
                    <a class="btn btn-primary float-right" href="{{ $paginator->nextPageUrl() }}" rel="next">Antiguos Publicaciones →<!--&rarr;--></a>
                    {{-- <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a> --}}
                {{-- </li> --}}
            @else
                {{-- <li class="page-item disabled" aria-disabled="true"> --}}
                    {{-- <span class="page-link">@lang('pagination.next')</span> --}}
                    <span class="btn btn-primary float-right">Antiguas Publicaciones →</span>
                {{-- </li> --}}
            @endif
        </div>
        {{-- </ul> --}}
    </nav>
@endif

{{-- <div class="clearfix">
    <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
</div> --}}
