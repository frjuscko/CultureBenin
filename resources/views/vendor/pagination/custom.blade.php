@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <div class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="page-item disabled">
                    <span class="page-link">‹</span>
                </span>
            @else
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">‹</a>
            @endif

            {{-- Pagination Elements --}}
            <div class="pagination-numbers">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="page-item disabled">
                            <span class="page-link">{{ $element }}</span>
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </span>
                            @else
                                <a class="page-link" href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">›
                </a>
            @else
                <span class="page-item disabled">
                    <span class="page-link">›</span>
                </span>
            @endif
        </div>

        {{-- Informations --}}
        <div class="pagination-info">
            <p>
                Affichage de <strong>{{ $paginator->firstItem() }}</strong> 
                à <strong>{{ $paginator->lastItem() }}</strong> 
                sur <strong>{{ $paginator->total() }}</strong> éléments
            </p>
        </div>
    </nav>
@endif