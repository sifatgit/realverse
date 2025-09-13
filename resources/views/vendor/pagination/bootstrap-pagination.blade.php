<!-- resources/views/vendor/livewire/bootstrap-pagination.blade.php -->
<div class="pagination">
    <ul class="pagination">
        <!-- Previous Link -->
        <li class="page-item {{ ($units->onFirstPage()) ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $units->previousPageUrl() }}" tabindex="-1">Prev</a>
        </li>

        <!-- Pagination Links -->
        @foreach ($units->links() as $page => $url)
            <li class="page-item {{ ($page == $units->currentPage()) ? 'active' : '' }}">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach

        <!-- Next Link -->
        <li class="page-item {{ ($units->hasMorePages()) ? '' : 'disabled' }}">
            <a class="page-link" href="{{ $units->nextPageUrl() }}">Next</a>
        </li>
    </ul>
</div>
