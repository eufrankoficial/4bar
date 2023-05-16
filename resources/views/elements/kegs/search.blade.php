<div class="card">
    <div class="body">
        <h5 class="title">{{ __('Search') }}</h5>
        <form action="{{ route('taps.index') }}" method="GET">
            <div class="row">
                <select-org-branch orgsselect="{{ $orgs }}" org="false" branch="false"></select-org-branch>
            </div>
        </form>
    </div>
</div>
