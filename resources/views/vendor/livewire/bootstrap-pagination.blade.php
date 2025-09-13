@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

@if ($paginator->hasPages())
    <div class="d-flex justify-content-center my-3">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
                <li class="page-item">
                    <button type="button"
                            class="page-link"
                            wire:click="previousPage('{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                            wire:loading.attr="disabled"
                            aria-label="Previous">
                        &laquo;
                    </button>
                </li>
            @endif

            {{-- Page Numbers (serial, all as buttons, with current highlighted in-place) --}}
            @foreach (range(1, $paginator->lastPage()) as $page)
                <li class="page-item ">
                    <button type="button"
                            class="page-link {{ $page == $paginator->currentPage() ? 'active' : '' }}"
                            @if ($page == $paginator->currentPage()) disabled @endif
                            wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                            wire:loading.attr="disabled">
                        {{ $page }}
                    </button>
                </li>
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <button type="button"
                            class="page-link"
                            wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                            wire:loading.attr="disabled"
                            aria-label="Next">
                        &raquo;
                    </button>
                </li>
            @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
            @endif
        </ul>
    </div>
@endif
